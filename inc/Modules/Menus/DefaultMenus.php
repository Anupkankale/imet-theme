<?php
/**
 * Default menu items, taken from the original header and footer.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Menus;

/**
 * Class DefaultMenus
 *
 * The links each menu location starts with. MenuSeeder creates these menus once; after that they are managed in
 * Appearance > Menus.
 *
 * @since 1.2.0
 */
class DefaultMenus {

	/**
	 * Menus by location.
	 *
	 * @since 1.2.0
	 *
	 * @return array<string, array{name: string, items: array<int, array<string, mixed>>}> Location => menu.
	 */
	public static function all(): array {
		return [
			'primary' => [
				'name'  => 'Primary Menu',
				'items' => [
					[
						'title'    => 'Online Doctorate (DBA)',
						'url'      => '/online-doctorate-business-administration-dba-programs/',
						'children' => [
							[
								'title' => 'DBA in Cybersecurity',
								'url'   => '/online-doctorate-cybersecurity-certificate-program/',
							],
							[
								'title' => 'DBA in Artificial Intelligence (AI/ML)',
								'url'   => '/online-doctorate-dba-artificial-intelligence-ml/',
							],
							[
								'title' => 'DBA in Digital Transformation',
								'url'   => '/online-doctorate-digital-transformation-program/',
							],
							[
								'title' => 'DBA in Project Management',
								'url'   => '/online-doctorate-dba-project-management/',
							],
							[
								'title' => 'DBA in Generative AI',
								'url'   => '/online-doctorate-dba-generative-ai/',
							],
							[
								'title' => 'DBA in IT Governance',
								'url'   => '/online-doctorate-it-governance-risk-compliance/',
							],
						],
					],
					[
						'title'    => 'Online Master’s (MBA)',
						'url'      => '/online-masters-mba-degree-programs/',
						'children' => [
							[
								'title' => 'MBA in Cybersecurity',
								'url'   => '/online-masters-mba-cybersecurity-program/',
							],
							[
								'title' => 'MBA in Project Management',
								'url'   => '/online-masters-mba-project-management-program/',
							],
							[
								'title' => 'MBA in Data Analytics',
								'url'   => '/online-masters-mba-degree-data-analytics-program/',
							],
						],
					],
					[
						'title'    => 'Discover',
						'url'      => '#',
						'children' => [
							[
								'title' => 'About Us',
								'url'   => '/about-us/',
							],
							[
								'title' => 'Accreditation',
								'url'   => '/accreditation-and-recognition/',
							],
							[
								'title' => 'Convocation',
								'url'   => '/convocation-ceremony/',
							],
							[
								'title' => 'Success story',
								'url'   => '/success-stories/',
							],
							[
								'title' => 'Alumni video',
								'url'   => '/alumni-speak/',
							],
							[
								'title' => 'Case Studies',
								'url'   => '/case-studies/',
							],
							[
								'title' => 'Testimonials',
								'url'   => '/testimonials/',
							],
						],
					],
					[
						'title'    => 'Resources',
						'url'      => '#',
						'children' => [
							[
								'title' => 'Certificate Validation',
								'url'   => '/verification-results/',
							],
							[
								'title' => 'Assessment',
								'url'   => '/assessment/',
							],
							[
								'title' => 'Download Resources',
								'url'   => '/resources/',
							],
							[
								'title' => 'Blogs',
								'url'   => '/blog/',
							],
						],
					],
					[
						'title'   => 'Contact Us',
						'url'     => '/contact/',
						'classes' => 'imet-nav-contact',
					],
				],
			],
			'footer-main' => [
				'name'  => 'Footer: Main Menu',
				'items' => [
					[
						'title' => 'About Us',
						'url'   => '/about-us/',
					],
					[
						'title' => 'Why Choose Us',
						'url'   => '/why-choose-imet/',
					],
					[
						'title' => 'Blogs',
						'url'   => '/blog/',
					],
					[
						'title' => 'Privacy Policy',
						'url'   => '/privacy-policy/',
					],
					[
						'title' => 'Sitemap',
						'url'   => '/sitemap_index.xml',
					],
					[
						'title' => 'Contact Us',
						'url'   => '/contact/',
					],
				],
			],
			'footer-courses' => [
				'name'  => 'Footer: Courses',
				'items' => [
					[
						'title' => 'Online Doctorate (DBA) Programs',
						'url'   => '/online-doctorate-business-administration-dba-programs/',
					],
					[
						'title' => 'Online Master’s (MBA) Programs',
						'url'   => '/online-masters-mba-degree-programs/',
					],
					[
						'title' => 'Online Diploma Programs',
						'url'   => '/how-online-diploma-programs-can-boost-your-career-without-quitting-your-job/',
					],
				],
			],
			'footer-mba' => [
				'name'  => 'Footer: Online Master’s (MBA)',
				'items' => [
					[
						'title' => 'Online MBA in Cybersecurity',
						'url'   => '/online-masters-mba-cybersecurity-program/',
					],
					[
						'title' => 'Online MBA in Project Management',
						'url'   => '/online-masters-mba-project-management-program/',
					],
					[
						'title' => 'Online MBA in Data Analytics',
						'url'   => '/online-masters-mba-degree-data-analytics-program/',
					],
					[
						'title' => 'Online MBA in Supply Chain Management',
						'url'   => '/mba-supply-chain-management-online-programs-career-scope-and-sa/',
					],
				],
			],
			'footer-dba' => [
				'name'  => 'Footer: Online Doctorate (DBA)',
				'items' => [
					[
						'title' => 'DBA in Cybersecurity',
						'url'   => '/online-doctorate-cybersecurity-certificate-program/',
					],
					[
						'title' => 'DBA in AI/ML',
						'url'   => '/online-doctorate-dba-artificial-intelligence-ml/',
					],
					[
						'title' => 'DBA in Digital Transformation',
						'url'   => '/online-doctorate-digital-transformation-program/',
					],
					[
						'title' => 'DBA in Project Management',
						'url'   => '/online-doctorate-dba-project-management/',
					],
					[
						'title' => 'DBA in Generative AI',
						'url'   => '/online-doctorate-dba-generative-ai/',
					],
					[
						'title' => 'DBA in IT Governance',
						'url'   => '/online-doctorate-it-governance-risk-compliance/',
					],
				],
			],
			'footer-countries' => [
				'name'  => 'Footer: Doctorate Programs by Country',
				'items' => [
					[
						'title' => 'Doctorate (DBA) in UAE',
						'url'   => '/online-doctorate-degree-certificate-uae/',
					],
					[
						'title' => 'Doctorate (DBA) in Canada',
						'url'   => '/online-doctorate-dba-program-in-canada/',
					],
					[
						'title' => 'Doctorate (DBA) in USA',
						'url'   => '/doctorate-in-usa/',
					],
					[
						'title' => 'Doctorate (DBA) in Cybersecurity USA',
						'url'   => '/dba-in-cybersecurity-usa/',
					],
					[
						'title' => 'Doctorate (DBA) in Project Management USA',
						'url'   => '/dba-in-project-management-usa/',
					],
					[
						'title' => 'Doctorate (DBA) in Artificial Intelligence USA',
						'url'   => '/dba-in-artificial-intelligence-usa/',
					],
					[
						'title' => 'Doctorate (DBA) in UK',
						'url'   => '/online-doctorate-business-administration-dba-programs-uk/',
					],
					[
						'title' => 'Doctorate (DBA) in Cybersecurity UK',
						'url'   => '/online-doctorate-dba-in-cybersecurity-uk/',
					],
					[
						'title' => 'Doctorate (DBA) in Project Management UK',
						'url'   => '/online-doctorate-dba-project-management-uk/',
					],
					[
						'title' => 'Doctorate (DBA) in Artificial Intelligence UK',
						'url'   => '/doctorate-dba-in-artificial-intelligence-uk/',
					],
					[
						'title' => 'Doctorate (DBA) in Nigeria',
						'url'   => '/online-doctorate-business-administration-dba-programs-nigeria/',
					],
					[
						'title' => 'Doctorate (DBA) in Cybersecurity Nigeria',
						'url'   => '/online-doctorate-cybersecurity-certificate-program-nigeria/',
					],
					[
						'title' => 'Doctorate (DBA) in Project Management Nigeria',
						'url'   => '/online-doctorate-dba-project-management-nigeria/',
					],
					[
						'title' => 'Doctorate (DBA) in Artificial Intelligence Nigeria',
						'url'   => '/online-doctorate-dba-artificial-intelligence-ml-nigeria/',
					],
				],
			],
		];
	}
}
