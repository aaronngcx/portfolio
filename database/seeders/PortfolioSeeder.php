<?php

namespace Database\Seeders;

use CoreConstants;
use App\Services\Contracts\AboutInterface;
use App\Services\Contracts\EducationInterface;
use App\Services\Contracts\ExperienceInterface;
use App\Services\Contracts\MessageInterface;
use App\Services\Contracts\PortfolioConfigInterface;
use App\Services\Contracts\ProjectInterface;
use App\Services\Contracts\ServiceInterface;
use App\Services\Contracts\SkillInterface;
use App\Services\Contracts\VisitorInterface;
use Config;
use Illuminate\Database\Seeder;
use Log;
use Str;
use Faker\Factory as Faker;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $faker = Faker::create();

            $portfolioConfig = resolve(PortfolioConfigInterface::class);
            $about = resolve(AboutInterface::class);
            $education = resolve(EducationInterface::class);
            $skill = resolve(SkillInterface::class);
            $experience = resolve(ExperienceInterface::class);
            $project = resolve(ProjectInterface::class);
            $service = resolve(ServiceInterface::class);
            $visitor = resolve(VisitorInterface::class);
            $message = resolve(MessageInterface::class);

            //portfolio config table seed

            //template
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__TEMPLATE,
                'setting_value' => 'procyon',
                'default_value' => 'procyon',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //accent color
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__ACCENT_COLOR,
                'setting_value' => '#1890ff',
                'default_value' => '#1890ff',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //google analytics ID
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__GOOGLE_ANALYTICS_ID,
                'setting_value' => Config::get('custom.demo_mode') ? 'G-PS8JF33VLD' : '',
                'default_value' => Config::get('custom.demo_mode') ? 'G-PS8JF33VLD' : '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //maintenance mode
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__MAINTENANCE_MODE,
                'setting_value' => CoreConstants::FALSE,
                'default_value' => CoreConstants::FALSE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            //visibility
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_ABOUT,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_SKILL,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_EDUCATION,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_EXPERIENCE,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_PROJECT,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_SERVICE,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_CONTACT,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_FOOTER,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_CV,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_SKILL_PROFICIENCY,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            //header script
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__SCRIPT_HEADER,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //footer script
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__SCRIPT_FOOTER,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta title
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_TITLE,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta author
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_AUTHOR,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta description
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_DESCRIPTION,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta image
            try {
                if (is_dir('public/assets/common/img/meta-image')) {
                    $dir = 'public/assets/common/img/meta-image';
                } else {
                    $dir = 'assets/common/img/meta-image';
                }
                $leave_files = array('.gitkeep');
                
                foreach (glob("$dir/*") as $file) {
                    if (!in_array(basename($file), $leave_files)) {
                        unlink($file);
                    }
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_IMAGE,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);


            //about table seed
            try {
                try {
                    //avatar
                    if (is_dir('public/assets/common/img/avatar')) {
                        $dir = 'public/assets/common/img/avatar';
                    } else {
                        $dir = 'assets/common/img/avatar';
                    }
                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }

                    if (is_dir('public/assets/common/img/avatar')) {
                        copy('public/assets/common/default/avatar/default.png', $dir.'/default.png');
                    } else {
                        copy('assets/common/default/avatar/default.png', $dir.'/default.png');
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }

                try {
                    //cover
                    if (is_dir('public/assets/common/img/cover')) {
                        $dir = 'public/assets/common/img/cover';
                    } else {
                        $dir = 'assets/common/img/cover';
                    }
                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }

                    if (is_dir('public/assets/common/img/cover')) {
                        copy('public/assets/common/default/cover/default.png', $dir.'/default.png');
                    } else {
                        copy('assets/common/default/cover/default.png', $dir.'/default.png');
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }

                try {
                    //cv
                    if (is_dir('public/assets/common/cv')) {
                        $dir = 'public/assets/common/cv';
                    } else {
                        $dir = 'assets/common/cv';
                    }

                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }
                    if (is_dir('public/assets/common/default/cv/')) {
                        copy('public/assets/common/default/cv/default.pdf', $dir.'/default.pdf');
                    } else {
                        copy('assets/common/default/cv/default.pdf', $dir.'/default.pdf');
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }
                
                $data = [
                    'name' => 'Aaron Ng',
                    'email' => 'aaronngcx@gmail.com',
                    'avatar' => 'assets/common/img/avatar/default.png',
                    'cover' => 'assets/common/img/cover/default.png',
                    'phone' => '+60187942155',
                    'address' => 'Kuala Lumpur, Malaysia',
                    'description' => 'With a strong background in the information technology and services industry, I am an experienced software developer dedicated to delivering top-notch solutions that drive business growth and client success.',
                    'taglines' => ["I am Software Engineer", "I am Web Developer", "I am Full Stack Engineer"],
                    'social_links' => [
                        [
                            'title' => 'LinkedIn',
                            'iconClass' => 'fab fa-linkedin-in',
                            'link' => 'https://www.linkedin.com/in/aaron-ng-b9236a145/'
                        ],
                        [
                            'title' => 'Github',
                            'iconClass' => 'fab fa-github',
                            'link' => 'https://github.com/aaronngcx'
                        ],
                        // [
                        //     'title' => 'Twitter',
                        //     'iconClass' => 'fab fa-twitter',
                        //     'link' => 'https://twitter.com'
                        // ],
                        // [
                        //     'title' => 'Mail',
                        //     'iconClass' => 'far fa-envelope',
                        //     'link' => 'mailto:johndoe@example.com'
                        // ],
                    ],
                    'seederCV' => 'assets/common/cv/AaronNgSoftwareEngineer.pdf',
                ];
                $about->store($data);

                //education table seed
                try {
                    $data = [
                        'institution' => 'HELP University',
                        'period' => '2017-2019',
                        'degree' => 'Bachelor of Information Technology',
                        'cgpa' => '4.00 out of 4.00',
                        'department' => 'Computer Science & Engineering',
                        'thesis' => 'Web Development Track'
                    ];
                    $education->store($data);

                    $data = [
                        'institution' => 'HELP University',
                        'period' => '2015-2017',
                        'degree' => 'Diploma in Information Technology',
                        'cgpa' => '3.75 out of 4.00',
                        'department' => null,
                        'thesis' => null
                    ];
                    $education->store($data);
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            //skill table seed
            try {
                $data = [
                    'name' => 'Laravel',
                    'proficiency' => '100'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'PHP',
                    'proficiency' => '100'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'JavaScript',
                    'proficiency' => '95'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'React.js',
                    'proficiency' => '95'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'Vue.js',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'jQuery',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'MySQL',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'CSS',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'Node.js',
                    'proficiency' => '80'
                ];
                $skill->store($data);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            //experience table seed
            try {
                $data = [
                    'company' => 'Boss Boleh',
                    'period' => '2022-Present',
                    'position' => 'Senior Software Engineer (Team Lead)',
                    'details' => 'Responsible for effectively leading a team of five individuals to efficiently deliver results in the field of Software-as-a-Service (SaaS).'
                ];
                $experience->store($data);

                $data = [
                    'company' => 'Accenture',
                    'period' => '2022',
                    'position' => 'Senior Software Engineer',
                    'details' => 'Spearheaded the successful development of 3 product offerings, generating significant revenue and increasing
                    market share for a leading telecommunications company'
                ];
                $experience->store($data);

                $data = [
                    'company' => 'Strateq Group',
                    'period' => '2020-2022',
                    'position' => 'Software Engineer',
                    'details' => 'Spearheaded the research and development of an IoT integration project for a petrol retail solution that
                    operated in 7 countries leveraging technologies such as MQTT and AWS IoT Core'
                ];
                $experience->store($data);

                $data = [
                    'company' => 'Etctech',
                    'period' => '2019-2020',
                    'position' => 'Software Engineer',
                    'details' => "Led multiple web application development life cycles, right from the design stage to delivery and post-launch
                    support, ensuring that the projects were completed on time, within budget, and to the client's satisfaction"
                ];
                $experience->store($data);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            //project table seed
            try {
                try {
                    //images
                    if (is_dir('public/assets/common/img/projects')) {
                        $dir = 'public/assets/common/img/projects';
                    } else {
                        $dir = 'assets/common/img/projects';
                    }
                    
                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }

                $data = [
                    'title' => 'Demo Project 1',
                    'categories' => ['personal'],
                    'link' => 'https://www.youtube.com',
                    'details' => $faker->text(),
                    'seeder_thumbnail' => 'assets/common/img/projects/demo_project_1_1.png',
                    'seeder_images' => [
                        'assets/common/img/projects/demo_project_1_1.png',
                        'assets/common/img/projects/demo_project_1_2.png'
                    ]
                ];
                if (is_dir('public/assets/common/default/projects')) {
                    copy('public/assets/common/default/projects/demo_project_1_1.png', $dir.'/demo_project_1_1.png');
                    copy('public/assets/common/default/projects/demo_project_1_2.png', $dir.'/demo_project_1_2.png');
                } else {
                    copy('assets/common/default/projects/demo_project_1_1.png', $dir.'/demo_project_1_1.png');
                    copy('assets/common/default/projects/demo_project_1_2.png', $dir.'/demo_project_1_2.png');
                }
                
                $project->store($data);

                $data = [
                    'title' => 'Demo Project 2',
                    'categories' => ['professional'],
                    'link' => 'https://www.facebook.com',
                    'details' => $faker->text(),
                    'seeder_thumbnail' => 'assets/common/img/projects/demo_project_2_1.png',
                    'seeder_images' => [
                        'assets/common/img/projects/demo_project_2_1.png',
                        'assets/common/img/projects/demo_project_2_2.png'
                    ]
                ];

                if (is_dir('public/assets/common/default/projects')) {
                    copy('public/assets/common/default/projects/demo_project_2_1.png', $dir.'/demo_project_2_1.png');
                    copy('public/assets/common/default/projects/demo_project_2_2.png', $dir.'/demo_project_2_2.png');
                } else {
                    copy('assets/common/default/projects/demo_project_2_1.png', $dir.'/demo_project_2_1.png');
                    copy('assets/common/default/projects/demo_project_2_2.png', $dir.'/demo_project_2_2.png');
                }

                $project->store($data);

                $data = [
                    'title' => 'Demo Project 3',
                    'categories' => ['personal'],
                    'link' => 'https://www.linkedin.com',
                    'details' => $faker->text(),
                    'seeder_thumbnail' => 'assets/common/img/projects/demo_project_3_1.png',
                    'seeder_images' => [
                        'assets/common/img/projects/demo_project_3_1.png',
                        'assets/common/img/projects/demo_project_3_2.png'
                    ]
                ];
                
                if (is_dir('public/assets/common/default/projects')) {
                    copy('public/assets/common/default/projects/demo_project_3_1.png', $dir.'/demo_project_3_1.png');
                    copy('public/assets/common/default/projects/demo_project_3_2.png', $dir.'/demo_project_3_2.png');
                } else {
                    copy('assets/common/default/projects/demo_project_3_1.png', $dir.'/demo_project_3_1.png');
                    copy('assets/common/default/projects/demo_project_3_2.png', $dir.'/demo_project_3_2.png');
                }
                
                $project->store($data);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            //service table seed
            try {
                $data = [
                    'title' => 'Web Development',
                    'icon' => 'fas fa-code',
                    'details' => "My web development services create custom websites using the latest technologies and best practices. I handle front-end, back-end, database integration, CMS, e-commerce, and responsive design. With a focus on aesthetics, usability, and performance, I deliver high-quality websites to enhance your online presence and meet your goals."
                ];
                $service->store($data);

                $data = [
                    'title' => 'Mobile App Development',
                    'icon' => 'fas fa-basketball-ball',
                    'details' => "My mobile app development services provide innovative applications for iOS and Android. I work closely with you to understand your needs and target audience. From conceptualization to deployment, I create intuitive, feature-rich apps using cutting-edge tools. Stay ahead in the competitive app market with visually appealing and user-friendly mobile applications."
                ];
                $service->store($data);

                $data = [
                    'title' => 'Tech Consulting',
                    'icon' => 'fas fa-shield-alt',
                    'details' => "My technical consulting services provide specialized expertise and advice to assist you with your technical challenges and initiatives. Drawing upon my deep understanding of industry trends and technologies, I offer guidance on various technical areas such as software development, system architecture, infrastructure design, cybersecurity, cloud computing, and data management."
                ];
                $service->store($data);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            try {
                //visitor table seed
                foreach (range(1, 72) as $index) {
                    $data = [
                        'tracking_id' => Str::random(30),
                        'is_new' => $faker->boolean(60),
                        'ip' => $faker->ipv4,
                        'is_desktop' => $faker->boolean(70),
                        'browser' => $faker->randomElement(['Chrome', 'Firefox', 'Safari', 'Opera', 'Edge']),
                        'platform' => $faker->randomElement(['Windows', 'OS X', 'AndroidOS', 'iOS']),
                        'location' => $faker->country,
                        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                    ];
                    $visitor->forceStore($data);
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            try {
                //message table seed
                foreach (range(1, 17) as $index) {
                    $data = [
                        'name' => $faker->name(),
                        'email' => $faker->email,
                        'subject' => $faker->sentence(),
                        'body' => $faker->text(),
                        'replied' => $faker->boolean(60),
                        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                    ];
                    $message->store($data);
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}
