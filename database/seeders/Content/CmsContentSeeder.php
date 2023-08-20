<?php

namespace Database\Seeders\Content;

use App\Models\Content\CmsContent;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CmsContentSeeder extends Seeder
{
    public function run()
    {
        CmsContent::create([
            'title' => 'about_us',
            'displayName' => 'About Us',
            'seoTitle' => 'About Us',
            'seoDescription' => 'About Us',
            'content' => Factory::create()->paragraphs(3, true),
            'slug' => 'about-us',
            // culture nl or en
            'culture' => 'en',
        ]);

        CmsContent::create([
            'title' => 'privacy_policy',
            'displayName' => 'Privacy Policy',
            'seoTitle' => 'Privacy Policy',
            'seoDescription' => 'Privacy Policy',
            'content' => Factory::create()->paragraphs(3, true),
            'slug' => 'privacy-policy',
            // culture nl or en
            'culture' => 'en',
        ]);

        CmsContent::create([
            'title' => 'terms_and_conditions',
            'displayName' => 'Terms and Conditions',
            'seoTitle' => 'Terms and Conditions',
            'seoDescription' => 'Terms and Conditions',
            'content' => Factory::create()->paragraphs(3, true),
            'slug' => 'terms-and-conditions',
            // culture nl or en
            'culture' => 'en',
        ]);

        CmsContent::create([
            'title' => 'contact_us',
            'displayName' => 'Contact Us',
            'seoTitle' => 'Contact Us',
            'seoDescription' => 'Contact Us',
            'content' => Factory::create()->paragraphs(3, true),
            'slug' => 'contact-us',
            // culture nl or en
            'culture' => 'en',
        ]);

        CmsContent::create([
            'title' => 'faq',
            'displayName' => 'FAQ',
            'seoTitle' => 'FAQ',
            'seoDescription' => 'FAQ',
            'content' => Factory::create()->paragraphs(3, true),
            'slug' => 'faq',
            // culture nl or en
            'culture' => 'en',
        ]);

        //do all the above for nl
        CmsContent::create([
            'title' => 'about_us',
            'displayName' => 'Over Ons',
            'seoTitle' => 'Over Ons',
            'seoDescription' => 'Over Ons',
            'content' => Factory::create()->paragraphs(3, true),
            'slug' => 'over-ons',
            // culture nl or en
            'culture' => 'nl',
        ]);

        CmsContent::create([
            'title' => 'privacy_policy',
            'displayName' => 'Privacy Beleid',
            'seoTitle' => 'Privacy Beleid',
            'seoDescription' => 'Privacy Beleid',
            'content' => Factory::create()->paragraphs(3, true),
            'slug' => 'privacy-beleid',
            // culture nl or en
            'culture' => 'nl',
        ]);

        CmsContent::create([
            'title' => 'terms_and_conditions',
            'displayName' => 'Algemene Voorwaarden',
            'seoTitle' => 'Algemene Voorwaarden',
            'seoDescription' => 'Algemene Voorwaarden',
            'content' => Factory::create()->paragraphs(3, true),
            'slug' => 'algemene-voorwaarden',
            // culture nl or en
            'culture' => 'nl',
        ]);

        CmsContent::create([
            'title' => 'contact_us',
            'displayName' => 'Contact',
            'seoTitle' => 'Contact',
            'seoDescription' => 'Contact',
            'content' => Factory::create()->paragraphs(3, true),
            'slug' => 'contact',
            // culture nl or en
            'culture' => 'nl',
        ]);
    }
}
