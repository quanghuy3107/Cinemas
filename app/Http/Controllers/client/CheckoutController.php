<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\OrderModel;
use App\Models\admin\DetailRevenueModel;
use App\Models\admin\RevenueModel;
use App\Models\admin\SeatModel;


class CheckoutController extends Controller
{

    private $order;
    private $revenue;
    private $detailRevenue;
    private $seat;
    
    function execPostRequest($url, $data)
            {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data))
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                //execute post
                $result = curl_exec($ch);
                //close connection
                curl_close($ch);
                return $result;
            }
    public function checkOut(Request $request)
    {
        if ($request->isMethod('POST')) {
            $seat_Id = $request->seat_Id;
            $showtime_Id = $request->showtime_Id;
            $user_Id = $request->user_Id;
            $seat_Id = $request->seat_Id;
            $price = $request->price;
            $movie = $request->movie_Id;
            $seat_code = $request->seat_code;
            $url = "price={$price}&user_Id={$user_Id}&showtime_Id={$showtime_Id}&seat_Id={$seat_Id}&seat_code={$seat_code}&movie_Id={$movie}";
            
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $price;
            $orderId = time() ."";
            $redirectUrl = route('AddOrder'). '?' . $url;
            $ipnUrl = route('AddOrder') . '?' . $url;
            $extraData = "";


            if (!empty($_POST)) {
                

                $requestId = time() . "";
                $requestType = "payWithATM";
                // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $secretKey);
                $data = array('partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature);
                $result = $this -> execPostRequest($endpoint, json_encode($data));

                $jsonResult = json_decode($result, true);  // decode json

                //Just a example, please check more in there
                return redirect() -> to($jsonResult['payUrl']);
                // header('Location: ' . $jsonResult['payUrl']);
            }
        }
        
    }

    public function order(Request $request){

        $this -> order = new OrderModel();
        $this -> revenue = new RevenueModel();
        $this -> detailRevenue = new DetailRevenueModel();
        $this -> seat = new SeatModel();
        $listSeat = explode(",",$request -> seat_Id);
        $date = date('Y-m-d H:i:s');
        $data = [
            'order_code' => $request -> orderId,
            'seat_booked' => $request -> seat_code,
            'order_time' => $date,
            'quantity' => sizeof($listSeat) ,
            'total_money' => $request -> price,
            'user_Id' => $request -> user_Id,
            'showtime_Id' => $request -> showtime_Id,

        ];

        $addStatus = $this -> order -> insertOrder($data);

        if($addStatus){
            $dataRevenue= [
                'date' => $date,
                'price' => $request -> price,
            ];
            $id = $this -> revenue -> insertGetIdRevenue($dataRevenue);
            $this -> detailRevenue -> insertDetailRevenue(['revenue_Id' => $id, 'movie_Id' => $request->movie_Id]);
            foreach($listSeat as $seat){
                $this -> seat -> updateSeat($seat,['seat_status' => 'booked']);
            }
            return redirect() -> route('CheckOutSuccess');
        }else{
            $msg = 'Thanh toán thất bại';
            $type = 'danger';
            return redirect() -> route('index') -> with('msg',$msg) -> with('type', $type);
        }
        
    }

    public function checkOutSuccess(){
        $title = "Thanh toán thành công";
        return view('clients.checkOutSuccess', compact('title'));
    }
}
