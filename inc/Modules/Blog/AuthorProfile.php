<?php
/**
 * Author profile fields for the blog's author box.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Blog;

use WP_Block;
use WP_Comment;
use WP_Post;
use WP_User;
use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class AuthorProfile
 *
 * Adds two fields to Users > Profile for the author box under a blog article (templates/single.html):
 * - "Job title": shown under the author's name ("Content Strategist | cSuite Networks").
 * - "Author photo": the address of an image (Media Library > the image > Copy URL), used instead of the Gravatar.
 * The bio is WordPress's own "Biographical Info" and the LinkedIn link the "Website" field (see SinglePost).
 *
 * @since 1.1.21
 */
class AuthorProfile implements Registrable {

	/**
	 * User meta: job title.
	 *
	 * @since 1.1.21
	 * @var string
	 */
	public const JOB_TITLE = 'imet_job_title';

	/**
	 * User meta: author photo address.
	 *
	 * @since 1.1.21
	 * @var string
	 */
	public const PHOTO = 'imet_author_photo';

	/**
	 * Register hooks.
	 *
	 * @since 1.1.21
	 */
	public function register_hooks(): void {
		add_action( 'show_user_profile', [ $this, 'fields' ] );
		add_action( 'edit_user_profile', [ $this, 'fields' ] );
		add_action( 'personal_options_update', [ $this, 'save' ] );
		add_action( 'edit_user_profile_update', [ $this, 'save' ] );
		add_filter( 'pre_get_avatar_data', [ $this, 'avatar' ], 10, 2 );
		add_filter( 'render_block_core/post-author', [ $this, 'job_title' ], 10, 3 );
	}

	/**
	 * Print the fields on the profile screen.
	 *
	 * @since 1.1.21
	 *
	 * @param WP_User $user The user being edited.
	 */
	public function fields( WP_User $user ): void {
		?>
		<h2><?php esc_html_e( 'Blog author box', 'imet-theme' ); ?></h2>
		<table class="form-table" role="presentation">
			<tr>
				<th><label for="imet_job_title"><?php esc_html_e( 'Job title', 'imet-theme' ); ?></label></th>
				<td>
					<input type="text" name="imet_job_title" id="imet_job_title" class="regular-text" value="<?php echo esc_attr( (string) get_user_meta( $user->ID, self::JOB_TITLE, true ) ); ?>" />
					<p class="description"><?php esc_html_e( 'Shown under your name in the author box of your articles, e.g. "Content Strategist | cSuite Networks".', 'imet-theme' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><label for="imet_author_photo"><?php esc_html_e( 'Author photo', 'imet-theme' ); ?></label></th>
				<td>
					<input type="url" name="imet_author_photo" id="imet_author_photo" class="regular-text code" value="<?php echo esc_attr( (string) get_user_meta( $user->ID, self::PHOTO, true ) ); ?>" />
					<p class="description"><?php esc_html_e( 'Address of a square image: Media > Library > the image > Copy URL. Used instead of the Gravatar picture. Your LinkedIn link is the Website field above.', 'imet-theme' ); ?></p>
				</td>
			</tr>
		</table>
		<?php
	}

	/**
	 * Save the fields (nonce and capability checked).
	 *
	 * @since 1.1.21
	 *
	 * @param int $user_id The user being saved.
	 */
	public function save( int $user_id ): void {
		$nonce = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'update-user_' . $user_id ) || ! current_user_can( 'edit_user', $user_id ) ) {
			return;
		}

		if ( isset( $_POST['imet_job_title'] ) ) {
			update_user_meta( $user_id, self::JOB_TITLE, sanitize_text_field( wp_unslash( $_POST['imet_job_title'] ) ) );
		}

		if ( isset( $_POST['imet_author_photo'] ) ) {
			update_user_meta( $user_id, self::PHOTO, esc_url_raw( wp_unslash( $_POST['imet_author_photo'] ) ) );
		}
	}

	/**
	 * Use the author photo as the avatar.
	 *
	 * @since 1.1.21
	 *
	 * @param array<string, mixed> $args        Avatar data.
	 * @param mixed                $id_or_email User ID, email, WP_User, WP_Post or WP_Comment.
	 *
	 * @return array<string, mixed> Avatar data.
	 */
	public function avatar( array $args, $id_or_email ): array {
		$user_id = $this->user_id( $id_or_email );
		$photo   = $user_id ? (string) get_user_meta( $user_id, self::PHOTO, true ) : '';

		if ( '' !== $photo ) {
			$args['url'] = $photo;
		}

		return $args;
	}

	/**
	 * Put the job title under the name in the Post Author block.
	 *
	 * @since 1.1.21
	 *
	 * @param string               $content Block HTML.
	 * @param array<string, mixed> $block   Parsed block.
	 * @param WP_Block|null        $instance Block instance.
	 *
	 * @return string Block HTML.
	 */
	public function job_title( string $content, array $block, $instance = null ): string {
		$post_id = $instance instanceof WP_Block ? (int) ( $instance->context['postId'] ?? 0 ) : (int) get_the_ID();
		$post    = $post_id ? get_post( $post_id ) : null;
		$title   = $post ? (string) get_user_meta( (int) $post->post_author, self::JOB_TITLE, true ) : '';

		if ( '' === $title ) {
			return $content;
		}

		return (string) preg_replace(
			'#(<p class="wp-block-post-author__name">.*?</p>)#s',
			'$1<p class="wp-block-post-author__role">' . esc_html( $title ) . '</p>',
			$content,
			1
		);
	}

	/**
	 * The user behind an avatar request.
	 *
	 * @param mixed $id_or_email User ID, email, WP_User, WP_Post or WP_Comment.
	 *
	 * @return int User ID, or 0.
	 */
	private function user_id( $id_or_email ): int {
		if ( is_numeric( $id_or_email ) ) {
			return (int) $id_or_email;
		}

		if ( $id_or_email instanceof WP_User ) {
			return (int) $id_or_email->ID;
		}

		if ( $id_or_email instanceof WP_Post ) {
			return (int) $id_or_email->post_author;
		}

		if ( $id_or_email instanceof WP_Comment ) {
			return (int) $id_or_email->user_id;
		}

		if ( is_string( $id_or_email ) && is_email( $id_or_email ) ) {
			$user = get_user_by( 'email', $id_or_email );

			return $user ? (int) $user->ID : 0;
		}

		return 0;
	}
}
