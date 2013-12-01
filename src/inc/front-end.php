<?php
	// Get the current page ID
	global $id;
	// Start widget
	echo $before_widget;

	// Display the widget title
	echo $before_title . $title . $after_title;
	echo "<a class='sort_order' href=''>Toggle Sort Order</a>";
	
	// Get the list of the subpages related to the current page
	$pages_asc = get_pages( array( 'child_of' => $id, 'parent'=> $id, 'hierarchical' => 0, 'depth' => 1, 'sort_column' => 'post_title', 'sort_order' => 'asc' ) );
	$pages_desc = get_pages( array( 'child_of' => $id, 'parent'=> $id, 'hierarchical' => 0, 'depth' => 1, 'sort_column' => 'post_title', 'sort_order' => 'desc' ) );

	// Create 2 list of element to display the items in ascending and descending order
	for ( $i=0; $i<2; $i++) {

		$order = $i==0 ? 'asc' : 'desc';
		$variable = 'pages_'.$order;

		echo "<ul class='somc-andreasonny-subpages " . $order . "''>";
		
		// Check if there are subpageges present
		if (!empty($pages_asc)) {

			foreach($$variable as $page)
			{
				$children = get_pages('child_of='.$page->ID.'&sort_order='.$order.'&parent='.$page->ID);
				
				// Get the page title and trunc it after 20 characters
				$page_title = $page->post_title;
				$title_length = strlen($page_title);
				$page_title = (strlen($page_title) > 20) ? substr($page_title,0,20).'...' : $page_title;
				
				// Search for children pages
				if (!empty($children)) {
					
					// Get the children title and trunc it after 20 characters
					$children_title = $children->post_title;
					$children_length = strlen($children_title);
					$children_title = (strlen($children_title) > 20) ? substr($children_title,0,20).'...' : $children_title;

					// Display item list
					echo '<li class="children"><a href="' . get_page_link($page->ID) . '">' . $page->post_title . '</a>';
					echo '<ul><li><a href="' . get_page_link($page->ID) . '">' . $page->post_title . '</a>';
				    foreach ($children as $child) {
				        echo '<li><a href="' . get_page_link($child->ID) . '"> -- ' . $child->post_title . '</a></li>';
				    }
				    echo '</li></ul>';
				}
				else {
					// Display item list
					echo '<li><a href="' . get_page_link($page->ID) . '">' . $page_title . '</a></li>';
				}
			}
		}
		else {
			echo '<li class="empty">No subpages presents</li>';
		}
		echo "</ul>";

	}

	// Close widget
	echo $after_widget;
?>