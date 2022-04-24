<?php

	function belajar_api_plugin_get($page,$per_page){
		$per_page = $per_page;
		$total_post = wp_count_posts( $post_type = 'product' );
		$jumlah_post = (int)$total_post->publish;
		$jumlah_page = ceil($jumlah_post / $per_page);
	    $arr = [];
	    $artikel = [];
		$args = array(
	        'post_type' => 'product',
	        'paged' => $page,
	   		'posts_per_page' => $per_page
	    );
		$query = new WP_Query($args);
		if ($query->have_posts() ) : 
			while ( $query->have_posts() ) : $query->the_post();
				$data["id"] = get_the_ID();
				$data["title"] = get_the_title();
				$data["value"] = get_the_permalink();
				array_push($artikel, $data);
			endwhile;
			wp_reset_postdata();
		endif;
		$respon = [];
		$respon["status"] = "success";
		$respon["message"] = "berhasil";
		$respon["page"] = $page;
		$respon["per_page"] = $per_page;
		$respon["total"] = $jumlah_post;
		$respon["total_pages"] = $jumlah_page;
		$respon["data"] = $artikel;
		return $respon;
	}
	function belajar_api_plugin_post($judul = "Default Judul",$deskripsi = "Default deskripsi"){

		$post_data = array(
			'post_title' => $judul,
			'post_type' => 'product',
			'post_content' => $deskripsi,
			'post_status'   => 'publish',
		);
		$post_id = wp_insert_post( $post_data );

		$respon = [];
		$respon["status"] = "success";
		$respon["message"] = "berhasil";
		$respon["data"] = array(
			"id" => $post_id
		);
		return $respon;
	}
	function belajar_api_plugin_put($id = 216, $judul = "Default Edit Judul",$deskripsi = "Default Edit deskripsi"){
		$post_data = array(
			'ID'           => $id,
			'post_title'   => $judul,
			'post_content' => $deskripsi,
			'post_type' => 'product'
		);

		wp_update_post( $post_data );
		$respon = [];
		$respon["status"] = "success";
		$respon["message"] = "berhasil";
		$respon["data"] = array("id" => $id);
		return $respon;
	}
	function belajar_api_plugin_delete($id = 216){
		wp_delete_post($id);
		$respon = [];
		$respon["status"] = "success";
		$respon["message"] = "berhasil";
		$respon["data"] = array("id" => $id);
		return $respon;
	}