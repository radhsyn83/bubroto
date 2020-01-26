<?php
if(!function_exists('JSON'))
{
	function JSON($data, $msg = "sukses", $error = 0)
	{
		$res["msg"] = $msg;
		$res["error"] = $error;
		$res["data"] = $data;

		echo json_encode($res);
	}
}
if(!function_exists('CART'))
{
	function CART($data, $grand)
	{
		$dataCart = array();
		foreach ($data as $d) {
			$total = (int) $d['price'] * (int) $d['qty'];
			$data = array(
				'rowid' => $d['rowid'],
				'id' => $d['id'],
				'qty' => $d['qty'],
				'price' => number_format($d['price']),
				'name' => $d['name'],
				'status' => $d['status'],
				'total' => number_format($total)
			);
			$dataCart[] = $data;
		}

		$res = new stdClass();
		$res->data = $dataCart;
		$res->grand = $grand;

		echo json_encode($res);
	}
}
