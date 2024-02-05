<?php
require_once("Connect.php");
require_once("TableNames.php");

// $cat_query_list = [
//     "INSERT INTO $category_table VALUES (0, 'Shirts')",
//     "INSERT INTO $category_table VALUES (0, 'Pants')",
//     "INSERT INTO $category_table VALUES (0, 'Watches')"
// ];

// foreach ($cat_query_list as $each) :
//     try {
//         $pdo->exec($each);
//     } catch (PDOException $pde) {
//         echo $pde->getMessage();
//     }
// endforeach;

// echo "Categories inserted" . "<br>";

// $size_query_list = [
//     "INSERT INTO $size_table VALUES (0, 1, 'XS')",
//     "INSERT INTO $size_table VALUES (0, 1, 'Small')",
//     "INSERT INTO $size_table VALUES (0, 1, 'Medium')",
//     "INSERT INTO $size_table VALUES (0, 1, 'Large')",
//     "INSERT INTO $size_table VALUES (0, 1, 'XL')",
//     "INSERT INTO $size_table VALUES (0, 1, 'XXL')",
//     "INSERT INTO $size_table VALUES (0, 2, '28')",
//     "INSERT INTO $size_table VALUES (0, 2, '30')",
//     "INSERT INTO $size_table VALUES (0, 2, '32')",
//     "INSERT INTO $size_table VALUES (0, 2, '34')",
//     "INSERT INTO $size_table VALUES (0, 2, '36')",
//     "INSERT INTO $size_table VALUES (0, 2, '38')",
//     "INSERT INTO $size_table VALUES (0, 2, '40')",
//     "INSERT INTO $size_table VALUES (0, 3, '38mm')",
//     "INSERT INTO $size_table VALUES (0, 3, '40mm')",
//     "INSERT INTO $size_table VALUES (0, 3, '42mm')",
//     "INSERT INTO $size_table VALUES (0, 3, '44mm')",
// ];

// foreach ($size_query_list as $each) :
//     try {
//         $pdo->exec($each);
//     } catch (PDOException $pde) {
//         echo $pde->getMessage();
//     }
// endforeach;

// echo "Sizes inserted" . "<br>";

// $product_query_list = [
//     "INSERT INTO $product_table VALUES (0, 1, 4,'Nike Sportswear Full-Zip Hoodie', 180000.00, 10, 'Blending 2 of our most iconic looks, this full-zip hoodie draws design inspiration from our timeless Windrunner jacket as well as our Tech Fleece jacket.', 'images/nike_men_full_zip_hoodie.png')",
//     "INSERT INTO $product_table VALUES (0, 1, 3,'Nike Sportswear Chill Knit', 145000.00, 15, 'Grounded in style, comfort and versatility, meet our take on luxury loungewear. Soft, ribbed fabric keeps you comfortable while you rock the body-skimming look and low-cut back.', 'images/nike_sportswear_chill_knit.jpeg')",
//     "INSERT INTO $product_table VALUES (0, 1, 2,'H&M Kid T-Shirt', 90000.00, 18, 'Shirt with soft, brushed inside. Round neck, dropped shoulders, and long sleeves. Ribbing at neck, cuffs, and hem.', 'images/h_&_m_kid_t_shirt.png')",
//     "INSERT INTO $product_table VALUES (0, 1, 1,'Zara Kid Short Knit Coat', 120000.00, 13, 'Coat with a shirt collar and long sleeves. Button-up front. Front pockets.', 'images/zara_kid_short_knit_coat.jpeg')",
//     "INSERT INTO $product_table VALUES (0, 1, 2,'H&M Shoulder Pad Top', 200000.00, 20, 'Short, fitted top in a soft knit made from a cotton blend with a round neckline, shoulder pads and short sleeves. Ribbing around neckline, cuffs and hem.', 'images/h_&_m_shoulder_pad_top.jpeg')",
//     "INSERT INTO $product_table VALUES (0, 1, 5,'Adidas Tranining Tee', 80000.00, 5, 'Made with at least 70% recycled materials. By reusing materials that have already been created, we help to reduce waste and our reliance on finite resources and reduce the footprint of the products we make.', 'images/adidas_tranining_tee.png')",
//     "INSERT INTO $product_table VALUES (0, 1, 6,'Adidas Sweatshirt', 210000.00, 8, 'Wear It Your Way, For A Unique Look. This Adidas Sweatshirt With Full Zipper And Hood With Drawstring Is An Extremely Versatile Garment That Fits Perfectly To Your Mobile Lifestyle. The Soft Sponge Structure Provides Exceptional Comfort And Casual Style.', 'images/adidas_w_inlin_ft_fzhd.png')",
//     "INSERT INTO $product_table VALUES (0, 1, 3, \"Giordano Men\'s Flannel Plaid Slim\", 75000.00, 15, 'Relaxed fit shirt made with flannel finish cotton fabric. Lapel collar and long sleeves with buttoned cuffs. Chest patch pockets. Front button closure.', 'images/giordano_mens_flannel_plaid_slim.jpg')",

//     "INSERT INTO $product_table VALUES (0, 2, 7,'Adidas Trio Cargo Pants', 180000.00, 10, 'Made with 100% recycled materials, this product represents just one of our solutions to help end plastic waste.', 'images/adidas_trio_cargo_pants.png')",
//     "INSERT INTO $product_table VALUES (0, 2, 8,'Adicolor Firebird Loose Track Pants', 145000.00, 15, 'Represent the adidas Originals lifestyle in all its authentic glory. These iconic Firebird track pants are built for comfort, movement and long-term wear, thanks to their super-soft tricot build.', 'images/adicolor_ firebird_loose_track_pants.png')",
//     "INSERT INTO $product_table VALUES (0, 2, 9,'Nike Sportswear Club Fleece', 90000.00, 18, 'A closet staple, the Nike Sportswear Club Fleece Pants combine classic style with the soft comfort of fleece for an elevated look that you really can wear every day.', 'images/nike_Sportswear_club_fleece.jpeg')",
//     "INSERT INTO $product_table VALUES (0, 2, 10,'Nike Dri-Fit Academy Shorts', 120000.00, 13, 'These performance shorts are great for the court, the playground or the couch. They are made of soft double knit pique matte fabric enhanced by quick-drying, moisture-wicking Dri-FIT technology to help kiddos stay cool and comfy at play and side seam pockets provide spots to stash small essentials.', 'images/nike_dri_fit_academy_shorts.jpeg')",
//     "INSERT INTO $product_table VALUES (0, 2, 11,'H&M Wide Leg Jeans', 200000.00, 20, '5-pocket jeans in washed cotton denim. High waist, adjustable, elasticized waistband, and zip fly with button. Wide legs.', 'images/h_&_m_wide_leg_jeans.jpeg')",
//     "INSERT INTO $product_table VALUES (0, 2, 12,'H&M Slim Fit Twill Joggers', 80000.00, 5, 'Slim-fit joggers in twill with a fitted silhouette. Covered elastic and a concealed drawstring at waistband, mock fly, diagonal side pockets, and welt back pockets.', 'images/h_&_m_slim_fit_twill_joggers.jpeg')",
//     "INSERT INTO $product_table VALUES (0, 2, 13,'Zara Zippered Nylon Pants', 210000.00, 8, 'Mid-rise pants with drawstring elastic waistband. Side pockets and patch pocket at leg. Zipper elastic hem.', 'images/zara_zippered_nylon_pants.jpeg')",
//     "INSERT INTO $product_table VALUES (0, 2, 7, 'Giordano Stretch Low Rise SLim Tapered Khakis', 75000.00, 15, 'Color 16 has two kinds of length. Color 09, 20,62 and 63 contain 97%cotton and 3% spandex. Other colors contain 98% cotton and 2% spandex.', 'images/giordano_stretch_low_rise_slim_tapered_khakis.jpeg')",

//     "INSERT INTO $product_table VALUES (0, 3, 15,'DW CLASSIC MESH ONYX BLACK', 310000.00, 10, 'Made with 100% recycled materials, this product represents just one of our solutions to help end plastic waste.', 'images/dw_classic_mesh_onyx_black.png')",
//     "INSERT INTO $product_table VALUES (0, 3, 14,'DW PETITE MELROSE', 245000.00, 15, 'A TIMELESS CLASSIC. Petite Melrose features an eggshell white dial and an undeniably elegant rose gold mesh strap. This watch elevates your everyday outfit, your mood and your spirit.', 'images/dw_petite_melrose.png')",
//     "INSERT INTO $product_table VALUES (0, 3, 16,'G-Shock DW-H5600-1', 280000.00, 18, 'Authentic fitness and health goes along with caring about the environment, too. That is why we have made the bezel and band from bio-based resin.', 'images/g_shock_dw_h5600_1.jpg')",
//     "INSERT INTO $product_table VALUES (0, 3, 15,'Fossil Rose Gold Tone Stainless Steel Mesh', 120000.00, 13, 'This 40mm Carlie Gen 6 Hybrid smartwatch gives you 1+ weeks battery life and features a rose-gold tone stainless steel mesh strap plus an always-on readout display so you can get your heart rate, message previews, weather and more at a glance.', 'images/fossil_rose_gold_tone_stainless_steel_mesh.png')",
//     "INSERT INTO $product_table VALUES (0, 3, 14,'Apple Watch Series 4', 450000.00, 3, 'Apple Watch Series 4 have a water resistance rating of 50 meters under ISO standard 22810:2010. This means that they may be used for shallow-water activities like swimming in a pool or ocean.', 'images/apple_watch.jpg')",
//     "INSERT INTO $product_table VALUES (0, 3, 15,'Rolex Lady Datejust', 900000.00, 5, 'This Oyster Perpetual Lady-Datejust in Oystersteel features a pink dial and an Oyster bracelet.', 'images/rolex_lady_datejust.png')",
//     "INSERT INTO $product_table VALUES (0, 3, 16,'MK Lexington Pavé Silver-Tone Watch', 250000.00, 8, 'Mid-rise pants with drawstring elastic waistband. Side pockets and patch pocket at leg. Zipper elastic hem.', 'images/mk_lexington_pave.jpeg')",
//     "INSERT INTO $product_table VALUES (0, 3, 17, 'DW CLASSIC ST MAWES', 350000.00, 15, 'The Classic St. Mawes, an integral part of the flagship Classic Collection, is a slim timepiece that sits perfectly on your wrist. With a flawlessly round and simple dial, a classy leather band and an elegant casing, you have a timepiece that proves that perfection in engineering not only is a possibility, but a reality.', 'images/dw_classic_st_mawes.png')",
// ];

// foreach ($product_query_list as $each) :
//     try {
//         $pdo->exec($each);
//     } catch (PDOException $pde) {
//         echo $pde->getMessage();
//     }
// endforeach;

// echo "Products inserted" . "<br>";

// $tag_query_list = [
//     "INSERT INTO $tag_table VALUES (0, 'Men')",
//     "INSERT INTO $tag_table VALUES (0, 'Women')",
//     "INSERT INTO $tag_table VALUES (0, 'Kids')",
//     "INSERT INTO $tag_table VALUES (0, 'Sport')",
//     "INSERT INTO $tag_table VALUES (0, 'Casual')",
//     "INSERT INTO $tag_table VALUES (0, 'Formal')",
//     "INSERT INTO $tag_table VALUES (0, 'Short')",
//     "INSERT INTO $tag_table VALUES (0, 'Long')",
//     "INSERT INTO $tag_table VALUES (0, 'Purple')",
//     "INSERT INTO $tag_table VALUES (0, 'Black')",
//     "INSERT INTO $tag_table VALUES (0, 'White')",
//     "INSERT INTO $tag_table VALUES (0, 'Gold')",
//     "INSERT INTO $tag_table VALUES (0, 'Pink/Rose')",
//     "INSERT INTO $tag_table VALUES (0, 'Red')",
//     "INSERT INTO $tag_table VALUES (0, 'Green')",
//     "INSERT INTO $tag_table VALUES (0, 'Blue')",
//     "INSERT INTO $tag_table VALUES (0, 'Brown')",
//     "INSERT INTO $tag_table VALUES (0, 'Silver')"
// ];

// foreach ($tag_query_list as $each) :
//     try {
//         $pdo->exec($each);
//     } catch (PDOException $pde) {
//         echo $pde->getMessage();
//     }
// endforeach;

// echo "Tags inserted" . "<br>";

// $product_tag_query_list = [
//     "INSERT INTO $product_tag_table VALUES (1, 1)",
//     "INSERT INTO $product_tag_table VALUES (1, 4)",
//     "INSERT INTO $product_tag_table VALUES (1, 8)",
//     "INSERT INTO $product_tag_table VALUES (1, 15)",
//     "INSERT INTO $product_tag_table VALUES (2, 2)",
//     "INSERT INTO $product_tag_table VALUES (2, 5)",
//     "INSERT INTO $product_tag_table VALUES (2, 8)",
//     "INSERT INTO $product_tag_table VALUES (2, 17)",
//     "INSERT INTO $product_tag_table VALUES (3, 3)",
//     "INSERT INTO $product_tag_table VALUES (3, 5)",
//     "INSERT INTO $product_tag_table VALUES (3, 7)",
//     "INSERT INTO $product_tag_table VALUES (3, 11)",
//     "INSERT INTO $product_tag_table VALUES (4, 3)",
//     "INSERT INTO $product_tag_table VALUES (4, 5)",
//     "INSERT INTO $product_tag_table VALUES (4, 8)",
//     "INSERT INTO $product_tag_table VALUES (4, 16)",
//     "INSERT INTO $product_tag_table VALUES (5, 2)",
//     "INSERT INTO $product_tag_table VALUES (5, 5)",
//     "INSERT INTO $product_tag_table VALUES (5, 7)",
//     "INSERT INTO $product_tag_table VALUES (5, 10)",
//     "INSERT INTO $product_tag_table VALUES (5, 11)",
//     "INSERT INTO $product_tag_table VALUES (6, 1)",
//     "INSERT INTO $product_tag_table VALUES (6, 4)",
//     "INSERT INTO $product_tag_table VALUES (6, 7)",
//     "INSERT INTO $product_tag_table VALUES (6, 10)",
//     "INSERT INTO $product_tag_table VALUES (7, 2)",
//     "INSERT INTO $product_tag_table VALUES (7, 4)",
//     "INSERT INTO $product_tag_table VALUES (7, 8)",
//     "INSERT INTO $product_tag_table VALUES (7, 10)",
//     "INSERT INTO $product_tag_table VALUES (8, 1)",
//     "INSERT INTO $product_tag_table VALUES (8, 5)",
//     "INSERT INTO $product_tag_table VALUES (8, 6)",
//     "INSERT INTO $product_tag_table VALUES (8, 8)",
//     "INSERT INTO $product_tag_table VALUES (8, 10)",
//     "INSERT INTO $product_tag_table VALUES (8, 11)",
//     "INSERT INTO $product_tag_table VALUES (9, 1)",
//     "INSERT INTO $product_tag_table VALUES (9, 4)",
//     "INSERT INTO $product_tag_table VALUES (9, 5)",
//     "INSERT INTO $product_tag_table VALUES (9, 8)",
//     "INSERT INTO $product_tag_table VALUES (9, 17)",
//     "INSERT INTO $product_tag_table VALUES (10, 2)",
//     "INSERT INTO $product_tag_table VALUES (10, 4)",
//     "INSERT INTO $product_tag_table VALUES (10, 5)",
//     "INSERT INTO $product_tag_table VALUES (10, 8)",
//     "INSERT INTO $product_tag_table VALUES (10, 9)",
//     "INSERT INTO $product_tag_table VALUES (11, 1)",
//     "INSERT INTO $product_tag_table VALUES (11, 4)",
//     "INSERT INTO $product_tag_table VALUES (11, 5)",
//     "INSERT INTO $product_tag_table VALUES (11, 8)",
//     "INSERT INTO $product_tag_table VALUES (11, 15)",
//     "INSERT INTO $product_tag_table VALUES (12, 3)",
//     "INSERT INTO $product_tag_table VALUES (12, 4)",
//     "INSERT INTO $product_tag_table VALUES (12, 5)",
//     "INSERT INTO $product_tag_table VALUES (12, 7)",
//     "INSERT INTO $product_tag_table VALUES (12, 14)",
//     "INSERT INTO $product_tag_table VALUES (13, 3)",
//     "INSERT INTO $product_tag_table VALUES (13, 5)",
//     "INSERT INTO $product_tag_table VALUES (13, 8)",
//     "INSERT INTO $product_tag_table VALUES (13, 16)",
//     "INSERT INTO $product_tag_table VALUES (14, 1)",
//     "INSERT INTO $product_tag_table VALUES (14, 4)",
//     "INSERT INTO $product_tag_table VALUES (14, 6)",
//     "INSERT INTO $product_tag_table VALUES (14, 8)",
//     "INSERT INTO $product_tag_table VALUES (14, 10)",
//     "INSERT INTO $product_tag_table VALUES (15, 2)",
//     "INSERT INTO $product_tag_table VALUES (15, 5)",
//     "INSERT INTO $product_tag_table VALUES (15, 8)",
//     "INSERT INTO $product_tag_table VALUES (15, 17)",
//     "INSERT INTO $product_tag_table VALUES (16, 1)",
//     "INSERT INTO $product_tag_table VALUES (16, 5)",
//     "INSERT INTO $product_tag_table VALUES (16, 6)",
//     "INSERT INTO $product_tag_table VALUES (16, 8)",
//     "INSERT INTO $product_tag_table VALUES (16, 17)",
//     "INSERT INTO $product_tag_table VALUES (17, 1)",
//     "INSERT INTO $product_tag_table VALUES (17, 5)",
//     "INSERT INTO $product_tag_table VALUES (17, 6)",
//     "INSERT INTO $product_tag_table VALUES (17, 10)",
//     "INSERT INTO $product_tag_table VALUES (18, 2)",
//     "INSERT INTO $product_tag_table VALUES (18, 5)",
//     "INSERT INTO $product_tag_table VALUES (18, 6)",
//     "INSERT INTO $product_tag_table VALUES (18, 11)",
//     "INSERT INTO $product_tag_table VALUES (18, 12)",
//     "INSERT INTO $product_tag_table VALUES (19, 3)",
//     "INSERT INTO $product_tag_table VALUES (19, 4)",
//     "INSERT INTO $product_tag_table VALUES (19, 5)",
//     "INSERT INTO $product_tag_table VALUES (19, 10)",
//     "INSERT INTO $product_tag_table VALUES (20, 2)",
//     "INSERT INTO $product_tag_table VALUES (20, 4)",
//     "INSERT INTO $product_tag_table VALUES (20, 6)",
//     "INSERT INTO $product_tag_table VALUES (20, 12)",
//     "INSERT INTO $product_tag_table VALUES (20, 13)",
//     "INSERT INTO $product_tag_table VALUES (21, 1)",
//     "INSERT INTO $product_tag_table VALUES (21, 2)",
//     "INSERT INTO $product_tag_table VALUES (21, 3)",
//     "INSERT INTO $product_tag_table VALUES (21, 4)",
//     "INSERT INTO $product_tag_table VALUES (21, 5)",
//     "INSERT INTO $product_tag_table VALUES (21, 10)",
//     "INSERT INTO $product_tag_table VALUES (22, 2)",
//     "INSERT INTO $product_tag_table VALUES (22, 6)",
//     "INSERT INTO $product_tag_table VALUES (22, 13)",
//     "INSERT INTO $product_tag_table VALUES (22, 18)",
//     "INSERT INTO $product_tag_table VALUES (23, 2)",
//     "INSERT INTO $product_tag_table VALUES (23, 5)",
//     "INSERT INTO $product_tag_table VALUES (23, 6)",
//     "INSERT INTO $product_tag_table VALUES (23, 13)",
//     "INSERT INTO $product_tag_table VALUES (23, 18)",
//     "INSERT INTO $product_tag_table VALUES (24, 1)",
//     "INSERT INTO $product_tag_table VALUES (24, 5)",
//     "INSERT INTO $product_tag_table VALUES (24, 6)",
//     "INSERT INTO $product_tag_table VALUES (24, 11)",
//     "INSERT INTO $product_tag_table VALUES (24, 17)",
//     "INSERT INTO $product_tag_table VALUES (24, 18)",
// ];

// foreach ($product_tag_query_list as $each) :
//     try {
//         $pdo->exec($each);
//     } catch (PDOException $pde) {
//         echo $pde->getMessage();
//     }
// endforeach;

// echo "Product Tag inserted" . "<br>";

$user_query_list = [
    "INSERT INTO $user_table VALUES (0, 'John Doe', 'john@gmail.com', 'Yangon, Tamwe', '12345678', '1', '')",
    "INSERT INTO $user_table VALUES (0, 'Suzy', 'suzy@gmail.com', 'Yangon, KyaukMyg', '12345678', '0', '')",
    "INSERT INTO $user_table VALUES (0, 'Mike', 'mike@gmail.com', 'Yangon, Thuwana', '12345678', '0', 'images/mock_profile.jpg')"
];

foreach ($user_query_list as $each) :
    try {
        $pdo->exec($each);
    } catch (PDOException $pde) {
        echo $pde->getMessage();
    }
endforeach;

echo "Users inserted" . "<br>";
