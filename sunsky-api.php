<?php
/**
 * Plugin Name: Sunsky API Integration
 * Description: A plugin to integrate with Sunsky Online API and display products.
 * Version: 1.0
 * Author: Your Name
 */

// Add a shortcode to display products
add_shortcode('sunsky_products', 'sunsky_display_products');

function sunsky_display_products()
{
    // API details
    $key = 'Panda-Prinz';
    $secret = 'jfej2wqflwqfa';
    $url = 'http://www.sunsky-api.com/openapi/product!search.do';
    $params = array(
        'gmtModifiedStart' => '10/31/2012'
    );

    // Generate signature
    $signature = generate_signature($params, $key, $secret);

    // Add key and signature to params
    $params['key'] = $key;
    $params['signature'] = $signature;

    // Make the API call
    $response = wp_remote_post($url, array(
        'body' => $params
    )
    );

    if (is_wp_error($response)) {
        return 'Error fetching data: ' . $response->get_error_message();
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    error_log(print_r($data, true));

    // Debugging: Print the raw response body
    // Remove this in production
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if (isset($data['result']) && $data['result'] == 'success') {
        if (isset($data['data']) && is_array($data['data'])) {
            $output = '<ul>';
            foreach ($data['data'] as $product) {
                if (is_array($product) && isset($product['name'])) {
                    $output .= '<li>' . $product['name'] . '</li>';
                }
            }
            $output .= '</ul>';
        } else {
            $output = 'No products found or data format is incorrect.';
        }
    } else {
        $output = 'Error: ' . implode(', ', $data['messages']);
    }

    return $output;
}

function generate_signature($params, $key, $secret)
{
    ksort($params);
    $concatenated_string = '';
    foreach ($params as $value) {
        $concatenated_string .= $value;
    }
    $concatenated_string .= $key . '@' . $secret;
    return md5($concatenated_string);
}



Array
                        (
                            [gmtModified] => 09/23/2023 02:01:02
                            [packWidth] => 380
                            [groupItemNo] => EDA0049944
                            [oem] => 
                            [unitHeight] => 20
                            [modelLabel] => Color
                            [gmtListed] => 09/21/2023 21:42:55
                            [packQty] => 200
                            [warehouse] => CN
                            [brandName] => 
                            [id] => 2945766
                            [withLogo] => 
                            [stock] => 0
                            [unitLength] => 180
                            [description] => 1. Made of PU leather and TPU material, it can work for a long time.<br>2. Fully protect the device from normal scratches, dirt, tears and wear.<br>3. Stand design, free your hands and watch videos easily.<br>4. 2 card slots and 1 cash compartment, can store your credit card, cash or small banknotes for daily needs, it is more convenient to travel.<br>5. Comes with a photo frame to store your favorite photos.<br>6. Easy access to all ports and buttons without removing the cover.
                            [name] => For Huawei Mate 60 Pro Cow Texture Flip Leather Phone Case(Green)
                            [unitWidth] => 90
                            [picCount] => 5
                            [optionList] => Array
                                (
                                    [items] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [itemNo] => EDA004994401C
                                                    [keywords] => For Huawei nova 11i / Maimang 20 5G 
                                                )

                                            [1] => Array
                                                (
                                                    [itemNo] => EDA004994404C
                                                    [keywords] => For Huawei Mate 60 
                                                )

                                            [2] => Array
                                                (
                                                    [itemNo] => EDA004994402C
                                                    [keywords] => For Huawei nova 11 Pro / nova 11 Ultra 
                                                )

                                            [3] => Array
                                                (
                                                    [itemNo] => EDA004994405C
                                                    [keywords] => For Huawei Mate 60 Pro 
                                                )

                                            [4] => Array
                                                (
                                                    [itemNo] => EDA004994403C
                                                    [keywords] => For Huawei nova 11 
                                                )

                                        )

                                    [display] => text
                                )

                            [goodsType] => 0
                            [itemNo] => EDA004994405C
                            [status] => 1
                            [categoryId] => 110265
                            [priceList] => Array
                                (
                                    [0] => Array
                                        (
                                            [key] => 1
                                            [value] => 2.66
                                        )

                                    [1] => Array
                                        (
                                            [key] => 2
                                            [value] => 2.63
                                        )

                                    [2] => Array
                                        (
                                            [key] => 10
                                            [value] => 2.61
                                        )

                                    [3] => Array
                                        (
                                            [key] => 20
                                            [value] => 2.55
                                        )

                                    [4] => Array
                                        (
                                            [key] => 50
                                            [value] => 2.47
                                        )

                                    [5] => Array
                                        (
                                            [key] => 100
                                            [value] => 2.37
                                        )

                                    [6] => Array
                                        (
                                            [key] => 200
                                            [value] => 2.29
                                        )

                                )

                            [packType] => EDA004994405C
                            [barcode] => 6922837204098
                            [modelList] => Array
                                (
                                    [0] => Array
                                        (
                                            [key] => EDA004994405A
                                            [value] => Black
                                        )

                                    [1] => Array
                                        (
                                            [key] => EDA004994405B
                                            [value] => Blue
                                        )

                                    [2] => Array
                                        (
                                            [key] => EDA004994405C
                                            [value] => Green
                                        )

                                    [3] => Array
                                        (
                                            [key] => EDA004994405D
                                            [value] => Brown
                                        )

                                )

                            [moq] => 0
                            [clearance] => 
                            [leadTimeLevel] => 1
                            [packWeight] => 17.000
                            [price] => 2.6600
                            [packLength] => 450
                            [baseImgCount] => 0
                            [unitWeight] => 0.084
                            [packHeight] => 360
                            [containsBattery] => 
                        )