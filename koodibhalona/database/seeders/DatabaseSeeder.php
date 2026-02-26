<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{HeroSlide, AboutSection, Objective, Service, GalleryItem, Plan, ContactInfo, SiteSetting};
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Admin user
        User::updateOrCreate(['email' => 'admin@koodibhalona.org'], [
            'name' => 'Admin',
            'password' => Hash::make('12345678'),
        ]);

        // Hero slides
        HeroSlide::create([
            'label' => 'Welcome to Koodibhalona Trust (R) and Sanatana Gnayna Kirana (R)',
            'title' => 'Serving Humanity with Compassion & Purpose',
            'subtitle' => '',
            'button_text' => 'About Us',
            'button_link' => '/about',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        // About section
        AboutSection::create([
            'title' => 'About Us',
            'description1' => 'Koodibhalona Trust is a charitable organization based in Bangalore, committed to serving society with compassion and integrity. We work across diverse areas — from education, health, and women empowerment to environmental protection and rural development.',
            'description2' => 'Our mission is to uplift communities, promote equality, and build a brighter future for all. Guided by empathy, integrity, and community service, we bring sustainable change where it\'s needed most.',
        ]);

        // Objective
        Objective::create([
            'youtube_url' => 'https://www.youtube.com/embed/videoseries?list=PLs4_HDYqoGI7cbLV59J_pkV3GS1J2Fy9Q',
            'list_items' => [
                'Relief of the poor, needy, and distressed',
                'Promotion of education and literacy',
                'Provision of medical relief and health awareness',
                'Women welfare and empowerment',
                'Child welfare and development',
                'Welfare of senior citizens',
                'Welfare of differently-abled persons',
                'Environmental protection, sustainability, and animal welfare',
                'Promotion of arts, culture, and heritage',
                'Legal aid, human rights awareness, and constitutional literacy',
                'Advancement of science, technology, and innovation',
                'Emergency relief and disaster response',
                'Promotion of yoga, meditation, and holistic wellness',
                'Rural development and infrastructure improvement',
                'Miscellaneous charitable activities contributing to social welfare and nation-building',
            ],
        ]);

        // Services
        $services = [
            ['tag'=>'Social Welfare · Humanitarian Aid · Relief','title'=>'Relief of the poor, needy, and distressed','description'=>'Koodibhalona Trust is deeply committed to helping those who are struggling to survive. We believe no individual should face poverty alone. Our relief initiatives address the most immediate needs — food, clothing, shelter, and emergency financial assistance — with compassion and care.'],
            ['tag'=>'Education · Literacy · Scholarships','title'=>'Promotion of education and literacy','description'=>'We believe a life transformed begins with education. We make quality education accessible through literacy campaigns, adult education initiatives, scholarship drives, and school support programs for those who need it most.'],
            ['tag'=>'Healthcare · Wellness · Medical Relief','title'=>'Provision of medical relief and health awareness','description'=>'We bridge the healthcare gap through free medical camps, medicine distribution, and community health awareness sessions on prevention, hygiene, nutrition, and disease management — ensuring no one is left without care.'],
            ['tag'=>'Women Welfare · Empowerment · Self-Reliance','title'=>'Women welfare and empowerment','description'=>'We address multifaceted challenges women face — education, economic opportunity, legal rights, and health. Through vocational training, skill development, and legal aid, we help women gain confidence and independence.'],
            ['tag'=>'Child Welfare · Development · Protection','title'=>'Child welfare and development','description'=>'Every child deserves a safe, nurturing environment. Our programs focus on education support, nutrition, child rights awareness, and rehabilitation of children from difficult circumstances.','sub_links'=>['Social & Educational Support','Child Adoption Assistance','Legal Parent Adoption Support','Educational Help for Poor and Needy Students','Community Welfare & Awareness Programs']],
            ['tag'=>'Senior Care · Elderly Welfare · Dignity','title'=>'Welfare of senior citizens','description'=>'We honour the contributions of our elders and ensure they live with dignity. Our programs include health screenings, companionship initiatives, geriatric care support, pension awareness camps, and elder abuse prevention drives.'],
            ['tag'=>'Disability Welfare · Inclusion · Accessibility','title'=>'Welfare of differently-abled persons','description'=>'We create an inclusive society where every individual has equal access to opportunities and dignity. We provide assistive devices, education support, vocational training, employment guidance, and inclusivity awareness programs.'],
            ['tag'=>'Environment · Sustainability · Animal Welfare','title'=>'Environmental protection, sustainability, and animal welfare','description'=>'We engage in tree plantation drives, waste management, water conservation, and eco-awareness workshops. We also champion animal welfare through rescue missions and rehabilitation programs.'],
            ['tag'=>'Culture · Arts · Heritage Preservation','title'=>'Promotion of arts, culture, and heritage','description'=>'We promote traditional arts, crafts, music, dance, and storytelling through festivals and training programs. We support local artisans and document indigenous practices to preserve them for future generations.'],
            ['tag'=>'Legal Aid · Human Rights · Constitutional Literacy','title'=>'Legal aid, human rights awareness, and constitutional literacy','description'=>'We conduct legal awareness camps, constitutional literacy workshops, and human rights programs. We provide free legal aid and consultation to those who cannot afford professional legal help.'],
            ['tag'=>'Science · Technology · Innovation','title'=>'Advancement of science, technology, and innovation','description'=>'We promote STEM education among underprivileged youth, organise science fairs and innovation workshops, and support young innovators from underserved communities to bridge the digital divide.'],
            ['tag'=>'Disaster · Emergency · Relief Response','title'=>'Emergency relief and disaster response','description'=>'When disaster strikes, Koodibhalona Trust is among the first to respond — distributing food, water, clothing, and medical supplies and coordinating with local authorities for swift and effective aid delivery.'],
            ['tag'=>'Yoga · Meditation · Holistic Wellness','title'=>'Promotion of yoga, meditation, and holistic wellness','description'=>'We promote wellness practices through regular yoga and meditation camps, accessible for all ages, with special focus on mental health and stress management for community well-being.'],
            ['tag'=>'Rural Development · Infrastructure · Community','title'=>'Rural development and infrastructure improvement','description'=>'We address road connectivity, sanitation, clean water access, housing support, and livelihood programs for farming communities. We work with government bodies and panchayats to implement grassroots solutions.'],
            ['tag'=>'Social Welfare · Nation Building · Community','title'=>'Miscellaneous charitable activities contributing to social welfare and nation-building','description'=>'Beyond defined focus areas, we respond to diverse needs — blood donation camps, voter awareness drives, inter-faith harmony initiatives, and community bonding programs that contribute to nation-building.'],
        ];
        foreach ($services as $i => $svc) {
            Service::create(array_merge($svc, ['sort_order' => $i + 1, 'is_active' => true]));
        }

        // Plans
        Plan::create(['name'=>'Supporter','icon'=>'🥉','price'=>500,'period'=>'month','description'=>'Join as a Supporter and help us make a difference every month.','features'=>['Monthly Newsletter','Certificate of Support','Name listed on website','Tax exemption under 80G'],'color'=>'#1a9e8f','is_featured'=>false,'sort_order'=>1,'is_active'=>true]);
        Plan::create(['name'=>'Friend','icon'=>'🥈','price'=>1000,'period'=>'month','description'=>'Be a trusted Friend of Koodibhalona — every rupee counts.','features'=>['Everything in Supporter','Quarterly impact report','Invitation to events','Personalised thank-you letter'],'color'=>'#6a0dad','is_featured'=>false,'sort_order'=>2,'is_active'=>true]);
        Plan::create(['name'=>'Patron','icon'=>'🥇','price'=>2500,'period'=>'month','description'=>'Become a Patron and directly sponsor our key programs.','features'=>['Everything in Friend','Program sponsorship badge','Annual Recognition Award','Priority volunteer scheduling','Video update from field teams'],'color'=>'#e87722','is_featured'=>true,'sort_order'=>3,'is_active'=>true]);
        Plan::create(['name'=>'Champion','icon'=>'💎','price'=>5000,'period'=>'month','description'=>'Our highest tier — Champion the cause at the biggest scale.','features'=>['Everything in Patron','Dedicated relationship manager','Board meeting invitation','Logo on all publications','Custom CSR impact report'],'color'=>'#1a3a8f','is_featured'=>false,'sort_order'=>4,'is_active'=>true]);

        // Contact info
        ContactInfo::create([
            'email' => 'koodibhalona@gmail.com',
            'phone' => '96638 13500',
            'phone2' => '89512 46888',
            'address' => 'No. 28, 1st Phase, 1st Cross, Teachers Colony, J.P. Nagar, Bangalore – 560078',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.61!2d77.5940!3d12.9166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae15b4fbfe7f71%3A0xf0b46c2f37f8e0a2!2sJ.P.%20Nagar%2C%20Bengaluru%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1700000000000',
        ]);

        // Site settings
        SiteSetting::set('site_name', 'Koodibhalona Trust (R)');
        SiteSetting::set('site_tagline', '& Sanatana Gnayna Kirana (R)');
        SiteSetting::set('footer_text', '© 2025 Koodibhalona Trust. All Rights Reserved.');
        SiteSetting::set('quote_text', 'Together, we can build a world where compassion has no boundaries.');
    }
}
