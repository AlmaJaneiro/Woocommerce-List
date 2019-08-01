<?php



add_filter( 'woocommerce_show_variation_price', '__return_true');


function woocommerce_variable_add_to_cart() {
	global $product, $post;
	$variations = $product->get_available_variations();
	echo "
	<table>
	   <tbody>";
	
		   foreach ($variations as $key => $value) {
	
			   echo"
			   <tr>
				   <td> <b>".implode('/', $value['attributes']). "</b> </td>
				   <td>".$value['price_html']."</td>
				   <td>
					   <form action= '".esc_url( $product->add_to_cart_url() )." ' method='post' enctype='multipart/form-data'>
						   <input type='hidden' name='variation_id' value='".$value['variation_id']."' />
						   <input type='hidden' name='product_id' value='".esc_attr( $post->ID )."' />
						   <input type='hidden' name='add-to-cart' value='".esc_attr( $post->ID )."' />";
						   if(!empty($value['attributes'])){
							   foreach ($value['attributes'] as $attr_key => $attr_value) {
							   
								   echo "<input type='hidden' name='".$attr_key."' value='".$attr_value."'>";
							   }
						   }
	   
						   echo "<button type='submit' class='single_add_to_cart_button button alt'>".apply_filters('single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $product->product_type)."</button>
					   </form>
				   </td>
			   </tr>";
		   }
	   echo"
		   </tbody>
	   </table>";
   }
