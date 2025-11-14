// ignore_for_file: avoid_print, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, non_constant_identifier_names, file_names

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Rider_controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/api_screens/data_store.dart';

class AddRiderController extends GetxController implements GetxService {
  RiderlistController riderlistController = Get.put(RiderlistController());

  TextEditingController Ridername = TextEditingController();
  TextEditingController Rideremail = TextEditingController();
  TextEditingController Ridercountrycode = TextEditingController();
  TextEditingController Ridermobile = TextEditingController();
  TextEditingController Riderpassword = TextEditingController();

  String? path;
  String? base64Image;

  String countryId = "";

  String pType = "";
  String pbuySell = "";
  String status = "";

  String couponImage = "";

  var selectedIndexes = [];

  var lat;
  var long;

  String Editimage = "";
  String Edittitle = "";
  String Editemail = "";
  String Editccode = "";
  String Editmobile = "";
  String Editpassword = "";
  String Editstatus = "";

  var elat;
  var elong;
  bool isLoading = false;
  getEditDetails(
      {String? Editriderimage,
      EditRtitle,
      EditRideremail,
      EditRccode,
      EditRmobile,
      EditRpassword,
      estatus}) {
    Editimage = Editriderimage ?? "";
    Edittitle = EditRtitle ?? "";
    Editemail = EditRideremail ?? "";
    Editccode = EditRccode ?? "";
    Editmobile = EditRmobile ?? "";
    Editpassword = EditRpassword ?? "";
    Editstatus = estatus ?? "";

    update();
  }

  getCurrentLatAndLong(double latitude, double longitude) {
    lat = latitude;
    long = longitude;
    update();
  }

  emptyAllDetails() {
    Ridername.text = "";
    Ridercountrycode.text = "";
    Ridermobile.text = "";
    Rideremail.text = "";
    Riderpassword.text = "";
    path = null;
    base64Image = "";
    status = "";
    couponImage = "";
    update();
  }

  addrider() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "status": status != "" ? status : "1",
      "title": Ridername.text,
      "email": Rideremail.text,
      "ccode": Ridercountrycode.text,
      "mobile": Ridermobile.text,
      "password": Riderpassword.text,
      "img": base64Image
    };
    print("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&$data");
    ApiWrapper.dataPost(AppUrl.addrider, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          riderlistController.riderlist();
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        Get.back();
        isLoading = true;
        update();
      }
    });
  }

  updaterider({String? recordid}) async {
    try {
      isLoading = false;
      var data = {
        "store_id": getData.read("StoreLogin")["id"],
        "status": status != "" ? status : "1",
        "title": Ridername.text,
        "email": Rideremail.text,
        "ccode": Ridercountrycode.text,
        "mobile": Ridermobile.text,
        "password": Riderpassword.text,
        "img": path != null ? base64Image.toString() : "0",
        "record_id": recordid,
      };
      Uri uri = Uri.parse(AppUrl.path + AppUrl.updaterider);
      var response = await http.post(
        uri,
        body: jsonEncode(data),
      );
      print("!!!!!!!!!!!!!updaterider!!!!!!!!!!!!!${data.toString()}");
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        riderlistController.riderlist();
        print(
            "^^^^^^^^^^^^^^^updaterider^^^^^^^^^^^^^^^^^^^${result.toString()}");
        ApiWrapper.showToastMessage(result["ResponseMsg"]);
      }
      Get.back();
      isLoading = true;
      update();
    } catch (e) {
      print(e.toString());
    }
  }
}
