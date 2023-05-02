<?php
return [
	'user_companies' => [
		"CO01"=>"LMI",
	    "CO02"=>"LMIEER",
	    "CO03"=>"OMAN",
	    "CO04"=>"LAPRIMA",
	    "CO05"=>"MASDAR"
	],
	'user_type' => [
		"1"=>"Administrator",
    "2"=>"Admin",
    "3"=>"Operation",
    "4"=>"Sales",
    "5"=>"Customer Care",
    "6"=>"Brand In Charge",
    "7"=>"Showroom Assistant",
	],

	'crmRelatedTo' => [
		"1"=>"Meeting",
		"2"=>"Quotation",
		"3"=>"Demo",
		"4"=>"Samples",
		"5"=>"Delivery",
		"6"=>"Cheque Collection",
		//"7"=>"Follow-up Meeting",
		"8"=>"Gul food",
		"9"=>"Inquiry",
		"10"=>"Training",
		"11"=>"orientation",
		"12"=>"Complaint",
		"13"=>"Cold Calling",
	],

	'crmRelatedToColor' => [
		"1"=>"cyan",
		"2"=>"orange",
		"3"=>"green",
		"4"=>"yellow",
		"5"=>"black",
		"6"=>"purple",
		"7"=>"blue",
		"8"=>"white",
		"9"=>"red",
		"10"=>"Red",
		"11"=>"magenta",
		"12"=>"pink",
		"13"=>"violet",
	],

	'sampleUserType' => [
	    "1","2","4","5","6","7"
	],
	'sampleshowAll' => [
	    "1","2","6","7"
	],
	'sample_status_action_userType' => [
	    "0"=>"6",
	    "1"=>"7",
	    "2"=>"4",
	    "3"=>"4",
	    "4"=>"4",
	    "5"=>"6",
   	],
   	'sample_status' => [
	    '0'=>'CRM Requested',
	    '1'=>'Brand Aproved',
	    '2'=>'Showroom Forwarded to Sales',
	    '3'=>'Dispatched',
	    '4'=>'Delivered',
	    '5'=>'Rejected',
	],
	'sample_status_action' => [
	    '0'=>'CRM Requested',
	    '1'=>'Sample ready & Forward',
	    '2'=>'Forwarded to Sales',
	    '3'=>'Dispatched to Customer',
	    '4'=>'Delivered to Customer',
	    '5'=>'Rejected',
	],
	'sample_action_department' => [
		'0'=>'1',
	],
	'sample_status_class' => [
	    '0'=>'primary',
	    '1'=>'info',
	    '2'=>'dark',
	    '3'=>'warning',
	    '4'=>'success',
	    '5'=>'danger',
	],
	'sample_department' => [
	    '0'=>'Brand',
	    '1'=>'Showroom',
	    '2'=>'Sales',
	    '3'=>'Delivery',
	    '4'=>'Customer',
	    '5'=>'Sales',
	],
	'sampleUpdation'=>[
		'6'=>'Customer okay to Proceed Deal',
		'7'=>'Customer Not happy with sample',
	],
	'new_customer' => [
		"0"=>"Existing",
		"1"=>"New",
		"2"=>"Existing",
	],
	'new_customer_class' => [
		"0"=>"text-primary",
		"1"=>"text-success",
		"2"=>"text-primary",
	],
	'inquiry_status' => [
		"0"=>"New",
		"1"=>"New",
		"2"=>"Quotation",
		"3"=>"Follow Up",
		"4"=>"Won",
		"5"=>"loss"
	],
	'inquiry_process' => [
		"0"=>"0%",
		"1"=>"25%",
		"2"=>"50%",
		"3"=>"75%",
		"4"=>"100%",
		"5"=>"100%"
	],
	'inquiry_status_btn' => [
		"0"=>"bg-gradient-secondary",
		"1"=>"bg-gradient-dark",
		"2"=>"bg-gradient-info",
		"3"=>"bg-gradient-primary",
		"4"=>"bg-gradient-success",
		"5"=>"bg-gradient-danger"
	],
	'inquiry_status_textClass' => [
		"0"=>"text-secondary",
		"1"=>"text-dark",
		"2"=>"text-info",
		"3"=>"text-primary",
		"4"=>"text-success",
		"5"=>"text-danger"
	],


  'inquiry_action' => [
    "0"=>"New Inquiry",
    "1"=>"Quotation Email",
    "2"=>"Follow Up",
    "3"=>"Negosiation",
    "4"=>"Marked as Inquiry Won",
    "5"=>"Marked as Inquiry Loss"
  ],

  
	'inquiry_quatation' => [
		"1"=>"Quotation Email Send"
	],

	'inquiry_followup' => [
		"1"=>"Follow Up Email Send",
		"2"=>"Negotiation Email Send"
	],

	'crm_status' => [
		"0"=>"New",
		"1"=>"New",
		"2"=>"Quotation",
		"3"=>"Follow Up",
		"4"=>"Won",
		"5"=>"Loss",
		"6"=>"Addressed and solved",
		"7"=>"Addressed but unsolved",
		"8"=>"Not addressed",
		"9"=>"Not relevant",
		"10"=>"Followed up with customer",
		"11"=>"Did not follow-up",
		"12"=>"Not relevant",
		"13"=> "Approved and order placed",
		"14"=> "Approved awaiting order",
		"15"=> "Approved but don’t want to add to menu",
		"16"=> "Not Approved due to Price",
		"17"=> "Not Approved due to Quality",
		"18"=> "Awaiting owners confirmation",
		"19"=> "Sample not tried yet",
	],

	'crm_action' => [
		"0"=>"New CRM Created",
		"1"=>"New CRM Created",
		"2"=>"Updated to Quotation",
		"3"=>"Created Followup",
		"4"=>"Marked as CRM Won",
		"5"=>"Marked as CRM Loss",
		"6"=>"Addressed and solved",
		"7"=>"Addressed but unsolved",
		"8"=>"Not addressed",
		"9"=>"Not relevant",
		"10"=>"Followed up with customer",
		"11"=>"Did not follow-up",
		"12"=>"Not relevant",
		"13"=> "Approved and order placed",
		"14"=> "Approved awaiting order",
		"15"=> "Approved but don’t want to add to menu",
		"16"=> "Not Approved due to Price",
		"17"=> "Not Approved due to Quality",
		"18"=> "Awaiting owners confirmation",
		"19"=> "Sample not tried yet",
	],

	'crm_process' => [
		"0"=>"0%",
		"1"=>"25%",
		"2"=>"50%",
		"3"=>"75%",
		"4"=>"100%",
		"5"=>"100%"
	],

	'crm_status_btn' => [
		"0"=>"bg-gradient-secondary",
		"1"=>"bg-gradient-danger",
		"2"=>"bg-gradient-info",
		"3"=>"bg-gradient-primary",
		"4"=>"bg-gradient-success",
		"5"=>"bg-gradient-danger",
		"6"=>"bg-gradient-dark",
		"7"=>"bg-gradient-dark",
		"8"=>"bg-gradient-dark",
		"9"=>"bg-gradient-dark",
		"10"=>"bg-gradient-info",
		"11"=>"bg-gradient-info",
		"12"=>"bg-gradient-info",
		"13"=>"bg-gradient-primary",
		"14"=>"bg-gradient-primary",
		"15"=>"bg-gradient-primary",
		"16"=>"bg-gradient-primary",
		"17"=>"bg-gradient-primary",
		"18"=>"bg-gradient-primary",
		"19"=>"bg-gradient-primary",
	],



	'crm_status_textClass' => [
		"0"=>"text-secondary",
		"1"=>"text-dark",
		"2"=>"text-info",
		"3"=>"text-info",
		"4"=>"text-success",
		"5"=>"text-danger",
		"6"=>"text-dark",
		"7"=>"text-dark",
		"8"=>"text-dark",
		"9"=>"text-dark",
		"10"=>"text-info",
		"11"=>"text-info",
		"12"=>"text-info",
		"13"=>"text-primary",
		"14"=>"text-primary",
		"15"=>"text-primary",
		"16"=>"text-primary",
		"17"=>"text-primary",
		"18"=>"text-primary",
		"19"=>"text-primary",
	],


	


	'crm_quatation' => [
		"1"=>"Quotation Email Send"
	],

	'crm_followup' => [
		"1"=>"Follow Up Email Send",
		"2"=>"Negotiation Email Send"
	],

	'aproval_status_btn' => [
		"Pending"=>"bg-gradient-info",
		"Approved"=>"bg-gradient-success",
		"Rejected"=>"bg-gradient-danger"
	],

	'image_extension' => [
		'jpg','jpeg','png','gif'
	],

	'customer_type' => [
		"0"=>"None",
		"1"=>"Walk In",
		"2"=>"Email",
		"3"=>"Telphone",
		"4"=>"Social Media",
		"5"=>"Sales Person"
	],

	'business_category' => [
		"1"=>"Ice Cream Shops",
	  "2"=>"Coffee Shops",
	  "3"=>"Restaurants",
	  "4"=>"Trade & Retail",
	  "5"=>"Hotels",
	  "6"=>"Chocolates",
	  "7"=>"Corporate Office",
	  "8"=>"Home Use- Private Individual",
	  "9"=>"Government",
	  "10"=>"Shisha Shops / Parlours",
	  "11"=>"Cafeterias",
	  "12"=>"Groceries",
	  "13"=>"Supermarket"
	],

	'marketing_channel' => [
		"0"=>"None",
		"1"=>"Social Media",
		"2"=>"Referral",
		"3"=>"Digital Screen",
		"4"=>"Web Site",
		"5"=>"Exhibition",
		"6"=>"Phone",
		"7"=>"Email",
	],

	'complaints_status_updation' => [
		"6"=>"Addressed and solved",
		"7"=>"Addressed but unsolved",
		"8"=>"Not addressed",
		"9"=>"Not relevant",
	],

	'inquiry_status_updation' => [
		"10"=>"Followed up with customer",
		"11"=>"Did not follow-up",
		"12"=>"Not relevant",
	],

	'sample_status_updation' => [
		"13"=> "Approved and order placed",
		"14"=> "Approved awaiting order",
		"15"=> "Approved but don’t want to add to menu",
		"16"=> "Not Approved due to Price",
		"17"=> "Not Approved due to Quality",
		"18"=> "Awaiting owners confirmation",
		"19"=> "Sample not tried yet",
	]


];

?>