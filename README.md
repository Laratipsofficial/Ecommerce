## An E-Commerce Website

It is an e-commerce website which is built as series in YouTube. [Here the YouTube link to the whole series](https://www.youtube.com/playlist?list=PL2DahmvUpeus118wGxq8a9o-Guo4JSGg7). I have made it free, so you can use it as you like.

## Support

You can support me by subscribing to my [YouTube channel - Laratips](https://www.youtube.com/c/Laratips).

If you want me to continue developing this package and want me to develop other similar series, then you help me financially by sending few bucks to my [Wise](https://wise.com/invite/ath/ashishd233) account in Nepalese 🇳🇵 currency. Or you could also support me with "Super Thanks" on YouTube.

My Wise email: ashish.dhamala2015@gmail.com

If you decide to support me, the please send me your twitter handle in mail so that I can shout-out about you on twitter.

## How to install

```sh
git clone git@github.com:Laratipsofficial/Ecommerce.git ecommerce
cd ecommerce
cp .env.example .env
composer install
npm install && npm run dev
php artisan key:generate
php artisan migrate --seed
```

Then you can login by going to `/admin/dashboard` route

You can find the login credentials in `database/seeders/DatabaseSeeder.php` file

## License

[MIT license](https://opensource.org/licenses/MIT).
