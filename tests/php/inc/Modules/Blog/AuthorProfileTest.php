<?php
/**
 * Test AuthorProfile class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Blog\AuthorProfile;
use IMET\Theme\Tests\TestCase;

/**
 * Class AuthorProfileTest
 *
 * @since 1.1.21
 */
class AuthorProfileTest extends TestCase {

	/**
	 * Instance under test.
	 *
	 * @var AuthorProfile
	 */
	private AuthorProfile $instance;

	/**
	 * Set up.
	 */
	public function setUp(): void {
		parent::setUp();

		$this->instance = new AuthorProfile();
	}

	/**
	 * Test class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', $this->instance );
	}

	/**
	 * Test the hooks are registered.
	 */
	public function test_registers_hooks(): void {
		$this->instance->register_hooks();

		$this->assertGreaterThan( 0, has_action( 'show_user_profile', [ $this->instance, 'fields' ] ) );
		$this->assertGreaterThan( 0, has_action( 'edit_user_profile', [ $this->instance, 'fields' ] ) );
		$this->assertGreaterThan( 0, has_action( 'personal_options_update', [ $this->instance, 'save' ] ) );
		$this->assertGreaterThan( 0, has_action( 'edit_user_profile_update', [ $this->instance, 'save' ] ) );
		$this->assertGreaterThan( 0, has_filter( 'pre_get_avatar_data', [ $this->instance, 'avatar' ] ) );
		$this->assertGreaterThan( 0, has_filter( 'render_block_core/post-author', [ $this->instance, 'job_title' ] ) );
	}

	/**
	 * Test saving the fields needs a valid nonce and the right to edit that user, and cleans the values.
	 */
	public function test_save(): void {
		$editor = self::factory()->user->create( [ 'role' => 'administrator' ] );
		$author = self::factory()->user->create( [ 'role' => 'author' ] );
		wp_set_current_user( $editor );

		$_POST = [
			'_wpnonce'          => wp_create_nonce( 'update-user_' . $author ),
			'imet_job_title'    => ' Content Strategist <b>|</b> cSuite ',
			'imet_author_photo' => 'https://example.com/photo.webp',
		];
		$this->instance->save( $author );

		$this->assertSame( 'Content Strategist | cSuite', get_user_meta( $author, AuthorProfile::JOB_TITLE, true ) );
		$this->assertSame( 'https://example.com/photo.webp', get_user_meta( $author, AuthorProfile::PHOTO, true ) );

		// Without a valid nonce nothing changes.
		$_POST = [
			'_wpnonce'       => 'nope',
			'imet_job_title' => 'Changed',
		];
		$this->instance->save( $author );

		$this->assertSame( 'Content Strategist | cSuite', get_user_meta( $author, AuthorProfile::JOB_TITLE, true ) );

		// An author can't change another user.
		wp_set_current_user( self::factory()->user->create( [ 'role' => 'author' ] ) );
		$_POST = [
			'_wpnonce'       => wp_create_nonce( 'update-user_' . $author ),
			'imet_job_title' => 'Changed',
		];
		$this->instance->save( $author );

		$this->assertSame( 'Content Strategist | cSuite', get_user_meta( $author, AuthorProfile::JOB_TITLE, true ) );
		$_POST = [];
	}

	/**
	 * Test the author photo replaces the avatar, for a user ID, a user object, a post and an email.
	 */
	public function test_avatar_uses_the_author_photo(): void {
		$author = self::factory()->user->create( [ 'user_email' => 'writer@example.com' ] );
		update_user_meta( $author, AuthorProfile::PHOTO, 'https://example.com/photo.webp' );
		$post = self::factory()->post->create_and_get( [ 'post_author' => $author ] );

		foreach ( [ $author, get_user_by( 'id', $author ), $post, 'writer@example.com' ] as $who ) {
			$this->assertSame( 'https://example.com/photo.webp', $this->instance->avatar( [], $who )['url'] );
		}

		$this->assertArrayNotHasKey( 'url', $this->instance->avatar( [], self::factory()->user->create() ) );
	}

	/**
	 * Test the job title goes under the name in the Post Author block.
	 */
	public function test_job_title_under_the_name(): void {
		$author = self::factory()->user->create();
		update_user_meta( $author, AuthorProfile::JOB_TITLE, 'Content Strategist' );
		$post_id = self::factory()->post->create( [ 'post_author' => $author ] );
		$html    = '<div class="wp-block-post-author"><div class="wp-block-post-author__content"><p class="wp-block-post-author__name">Writer</p><p class="wp-block-post-author__bio">Bio</p></div></div>';
		$block   = new WP_Block( [ 'blockName' => 'core/post-author' ], [ 'postId' => $post_id ] );

		$this->assertStringContainsString(
			'<p class="wp-block-post-author__name">Writer</p><p class="wp-block-post-author__role">Content Strategist</p>',
			$this->instance->job_title( $html, [], $block )
		);

		$other = new WP_Block( [ 'blockName' => 'core/post-author' ], [ 'postId' => self::factory()->post->create() ] );

		$this->assertSame( $html, $this->instance->job_title( $html, [], $other ) );
	}
}
