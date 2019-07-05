<?php

$config =
		[
			'admin_login' =>
			[
				[
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|trim'
				],
				[
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required'
				]
			],
			'customer_login' =>
			[
				[
					'field' => 'customer_official_id',
					'label' => 'Customer Id',
					'rules' => 'required|trim'
				],
				[
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required'
				]
			]
		];

?>
