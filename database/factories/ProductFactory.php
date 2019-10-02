<?php

use Faker\Generator as Faker;

$factory->define(\App\Model\User\Product::class, function (Faker $faker) {

    $name = $faker->sentence(rand(2,3));

    return [
        //
        'name' => $name,
        'slug' => str_slug($name),
        'category_id' => $faker->numberBetween($min = 1, $max = 3),
        'admin_id' => 1,
        'price' => $faker->numberBetween($min = 20000, $max = 50000),
        'image' => $faker->imageUrl($width=1920, $height=1283),
        'status' => 1,
        'quantity' =>  $faker->numberBetween($min = 15, $max = 25),
        'brief' => $faker->paragraph(rand(1,2)),
        'specs' => $faker->paragraph(rand(1,2)),
//        'description' => 'iOS 13 OS ensures user-friendly interface along with desired customization,Flaunts a triple rear camera with LED flash that helps capture flawless shots in low light conditions,Spatial audio provides an immersive surround sound experience',
//        'description' => $faker->paragraph(rand(5,10)),
        'description' => '<h2 style="font-style:italic"><span style="font-size:16px"><span style="font-family:Arial,Helvetica,sans-serif"><strong>Product Specifications</strong></span></span></h2>

<p><strong>BODY </strong></p>

<p>&nbsp;</p>

<ul>
	<li>Dimensions 158 x 77.8 x 8.1 mm (6.22 x 3.06 x 0.32 in)</li>
	<li>Weight 226 g (7.97 oz)</li>
	<li>Build Front/back glass, stainless steel frame</li>
	<li>SIM Single SIM (Nano-SIM and/or Electronic SIM card) or Dual SIM (Nano-SIM, dual stand-by) - for China</li>
	<li>IP68 dust/water resistant (up to 4m for 30 mins)</li>
	<li>Apple Pay (Visa, MasterCard, AMEX certified)</li>
</ul>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>DISPLAY </strong></p>

<p>&nbsp;</p>

<ul>
	<li>Type Super Retina XDR OLED capacitive touchscreen, 16M colors</li>
	<li>Size 6.5 inches, 102.9 cm2 (~83.7% screen-to-body ratio)</li>
	<li>Resolution 1242 x 2688 pixels, 19.5:9 ratio (~458 ppi density)</li>
	<li>Protection Scratch-resistant glass, oleophobic coating</li>
	<li>800 nits</li>
	<li>Dolby Vision</li>
	<li>HDR10</li>
	<li>Wide color gamut</li>
	<li>True-tone</li>
	<li>120 Hz touch-sensing</li>
</ul>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>PLATFORM </strong></p>

<p>&nbsp;</p>

<ul>
	<li>OS iOS 13</li>
	<li>Chipset Apple A13 Bionic (7 nm+)</li>
	<li>CPU Hexa-core (2x2.65 GHz Lightning + 4x1.8 GHz Thunder)</li>
	<li>GPU Apple GPU (4-core graphics)</li>
</ul>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>MEMORY </strong></p>

<p>&nbsp;</p>

<ul>
	<li>Card slot No</li>
	<li>Internal 64GB 4GB RAM, 256GB 4GB RAM, 512GB 4GB RAM</li>
</ul>

<p>&nbsp;</p>

<p><strong>MAIN CAMERA</strong></p>

<p>&nbsp;</p>

<ul>
	<li>Triple 12 MP, f/1.8, 26mm (wide), 1/2.55&quot;, 1.4&micro;m, PDAF, OIS</li>
	<li>12 MP, f/2.0, 52mm (telephoto), 1/3.4&quot;, 1.0&micro;m, PDAF, OIS, 2x optical zoom</li>
	<li>12 MP, f/2.4, 13mm (ultrawide)</li>
	<li>Features Quad-LED dual-tone flash, HDR (photo/panorama)</li>
	<li>Video 2160p@24/30/60fps, 1080p@30/60/120/240fps, HDR, stereo sound rec.</li>
</ul>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>SELFIE CAMERA</strong></p>

<p>&nbsp;</p>

<ul>
	<li>Dual 12 MP, f/2.2</li>
	<li>TOF 3D camera</li>
	<li>Features HDR</li>
	<li>Video 2160p@24/30/60fps, 1080p@30/60/120fps, gyro-EIS</li>
</ul>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>SOUND </strong></p>

<p>&nbsp;</p>

<ul>
	<li>Loudspeaker Yes, with stereo speakers</li>
	<li>5mm jack No
	<ul>
		<li>Active noise cancellation with dedicated mic</li>
	</ul>
	</li>
	<li>Dolby Atmos</li>
	<li>Dolby Digital Plus</li>
</ul>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>BATTERY </strong></p>

<p>&nbsp;</p>

<ul>
	<li>Non-removable Li-Ion 3969 mAh battery (15.04 Wh)</li>
	<li>Charging Fast battery charging 18W: 50% in 30 min</li>
	<li>USB Power Delivery 2.0</li>
	<li>Qi wireless charging</li>
	<li>Talk time Up to 20 h (multimedia)</li>
	<li>Music play Up to 80 h</li>
</ul>

<p>&nbsp;</p>',

    ];
});
