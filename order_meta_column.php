<?php

function get_products_header($order)
{

	/*
	* Data Structure Variable []
	*/
    $product_structure = ['headers' => ["pro_title" => "Product Totals - Name(s)", "pro_code" => "Code", "pro_qty" => "Quantity", "pro_price" => "Price"], 'body' => []];

   
	/*
	* foreach on order items
	*/
    foreach ($order->get_items() as $item_id => $item)
    {

		/*
		* Empty arrays() to push in data structure
		*/
        $body_array = [];


        /*
		* getting product $name, $quantity, $sku & price
		*/
        $product = $item->get_product();
        $name = $item->get_name();
        $quantity = $item->get_quantity();
        $sku = $product->get_sku();
        $item_total   = $item->get_total();


		/*
		* pushing product details in $body_array[]
		*/
		$body_array["pro_name"] = $name;
		$body_array["pro_code"] = $sku;
		$body_array["pro_quantity"] = $quantity;
		$body_array["pro_price"] = number_format( $item_total, 2 );



		/*
		* pushing $body_array[] in $product_structure["body"]
		*/
		$product_structure['body'][] = $body_array;
        

        

    }

    return $product_structure;

}
function table_list_of_products($order, $sent_to_admin, $plain_text, $email)
{
	// Setting Data structure array as a varaible
	$get_meta = get_products_header($order);

	/*
	*   -------------------------------------
	*  | Reason of using this as $key $value |
	*	-------------------------------------
	*
	*  You can play with $keys and if you have any custom variable you can use 
	*  that as key and check if array_key_exists('custom_key', $get_meta['headers'])
	*
	*/
?>
 <hr />
<table class="v1x_MsoNormalTable" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    	<tr>
		    <!--
	    	 --------------
			| Table Header |
			 --------------
		    -->
		    <?php foreach ($get_meta["headers"] as $headers) 
		    {

		    	?>
		    	<th style="padding: 3.75pt 3.75pt 3.75pt 3.75pt; text-align:left">
					<p class="v1x_MsoNormal" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif">
						<b>
							<span style="font-family: &quot;Arial&quot;,sans-serif">
							<?= $headers ?>
							</span>
						</b>
						</span>
					</p>
				</th>			    
		    	<?php
		    }?>
		</tr>
		<!--
		 -----------
		| Table Body|
		 ----------- 
		-->
		
		<?php

		foreach ($get_meta['body'] as $total_products) 
		{
			echo "<tr>";

			foreach ($total_products as $key => $product_detail) {
				?>
				<td style="padding: 3.75pt 3.75pt 3.75pt 0.75pt; text-align:left">
					<p class="v1x_MsoNormal" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif">
						<span style="font-size: 9.0pt; font-family: &quot;Arial&quot;,sans-serif">
							<?= $product_detail ?>
						</span>
					</p>
				</td>

				<?php
			}

			echo "</tr>";
		}
		?>
		</tr>
  	</tbody>
</table>
<hr />
<?php

}

/*
*
* You can change this action to whereever you like
*
*/
add_action('woocommerce_email_before_order_table', 'table_list_of_products', 20, 4);

