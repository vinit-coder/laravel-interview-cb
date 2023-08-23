<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class BookingController extends Controller
{
    /**
     * @param string $preffered_seat
     * @param integer $number_of_tickets
     * @return mixed
     */
    function bookSeat($preffered_seat, $number_of_tickets ){

        $res = $this->validateInputs($preffered_seat, $number_of_tickets);
        if(!$res["status"]){
            return $res;
        }
        
        $arr = \DB::table('seats')
            ->select("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T")
            ->get()->toArray();
        $json = json_encode($arr);

        $arr = json_decode($json, true);
        unset($json);
        $data = $res["data"];
        $i = ord($data["col"]);
        $s = $i-$number_of_tickets+1;
        $s = $s<65?65:$s;
        $e = $i+$number_of_tickets;
        $e = $e>85?85:$e;
        $f1= $s;
        $f2 =$s;
        $booked_list =[]; 
        
        
        $j = $data["row"]-1;
        
        $counter =0;
        for($i=$s; $i<$e; $i++ ){
            if($arr[$j][chr($i)]==0){
                $counter++;
                $f2++;
                if($counter==$number_of_tickets){
                    break;
                }
            }
            else{  $f1 = $i+1;
                $counter =0;
            }
           
        }

        if($counter==$number_of_tickets){
            for($i=$f1; $i<$f2; $i++){
               
                $arr[$j][chr($i)] =1;
                $booked_list[] = chr($i).($j+1);
                
            }
            \DB::table("seats")->where("id", $j+1)->update($arr[$j]);
            
            $res=[
                "status"=>true,
                "message"=>"Booked Successfully!",
                "booked_seats"=> $booked_list,
                "suggestions"=>[],
            ];
            return $res;

        }

        $res["status"] = false;
        $res["message"] = "Can't Book for requested seat.";
        $res["booked_seats"]= $booked_list;
        $res["suggestions"] =$this->checkSuggestions($arr, $data["row"], $data["col"], $number_of_tickets);
        return $res;
    }

    function handleBookingRequest(Request $request){
        $res =$this->bookSeat($request->seat, $request->number);
        
        if(!$res["status"]){
            request()->session()->flash("message",$res["message"]);
            request()->session()->flash("suggestions",$res["suggestions"]);
            return redirect("/");
        }
        session()->flash("success","Booked successfuly!");
        session()->flash("res",$res);
        return redirect("/");
        
    }
    
    
    function validateInputs($seat, $number){
        $message ="";
        $res = [
            "status"=>false,
            "message"=>null,
            ""
        ]; 

        $regx = "/^[A-T][1-9]0?$/";
        $seat = ucfirst($seat);
        if(preg_match($regx, $seat) && $number<6 && $number >0){
            $col = substr($seat, 0,1);
            $row = intval(substr($seat,1));
            $number = intval($number);
            $message = "";

            if($row<=10 && $number >0 && $number<=5){
                $res = [
                    "status"=>true,
                    "data"=>['row'=>$row, "col"=>$col, "number"=>$number],
                    "message"=>null,
                ]; 
                
                return $res;
            }
            
            if ($row>10){
                $message = $message."Please enter a valid seat.";
            }    
        }
        if (!preg_match($regx, $seat)){
            $message = $message."Please enter a valid seat.";
        }
        if ($number>5 || $number <1){
            $message = $message."You can book minimum 1 and maximum 5 tickets at a time.\n";
        }
        else{
            $message = $message. "Please enter a valid data."; 
        }
        
        $res["message"] =$message;
        $res["suggestions"] =[];
        return $res;
    }

    function checkSuggestions($arr,$row, $col, $number){
        $data = [];
        // $i = ord($col);
        // $start = 65;
        // $end = 85;
        // $j = $row-1;
        // $f1 = $start;
        // $f2 = $start;
        // $counter =0;
        // echo "<pre>";
        // for($i=$start; $i<$end; $i++ ){
        //     if($arr[$j][chr($i)]==0){
        //         $counter++;
                
        //         if($counter==$number){
        //             $suggestion = [];
        //             while($f1<=$f2){
        //                 $suggestion[] = chr($f1).($j+1);   
        //                 print_r(array($i, $counter, $f1, $f2, chr($f1).($j+1) ));
        //                 $f1++;
        //             }
        //             if(!empty($suggestion)){
        //                 $data[] = $suggestion;
        //             }    
        //             $counter =0;
        //         }
        //         $f2++;
        //     }
        //     else{  $f1 = $i+1;
        //             $f2 = $i+1;   
        //         $counter =0;
        //     }  
        // }
        // return $data;
/* -------------------------------------------------*/
        
        for($i = 0; $i<10; $i++){
            for($j = 65; $j<=85-$number; $j++ ){
                $temp =[];
                for($k=$j; $k <$j+$number; $k++){
                    if($arr[$i][chr($k)]==0){
                        $temp[] = chr($k).($i+1);
                    }
                    else{
                        $temp =[];
                        break;
                    }
                }
                if(!empty($temp)){
                    $data[]=$temp;
                }
            }
        }
        return $data;

    }
}
