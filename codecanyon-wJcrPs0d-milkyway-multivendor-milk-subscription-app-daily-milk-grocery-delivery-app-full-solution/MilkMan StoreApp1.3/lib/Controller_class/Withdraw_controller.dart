// ignore_for_file: avoid_print, unused_local_variable, file_names, prefer_interpolation_to_compose_strings

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/Modal_class/Payout_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class PayOutController extends GetxController implements GetxService {
  Payoutinfo? payoutInfo;
  bool isLoading = false;

  TextEditingController amount = TextEditingController();
  TextEditingController upi = TextEditingController();
  TextEditingController accountNumber = TextEditingController();
  TextEditingController bankName = TextEditingController();
  TextEditingController accountHolderName = TextEditingController();
  TextEditingController ifscCode = TextEditingController();
  TextEditingController emailId = TextEditingController();

  PayOutController() {
    getPayOutList();
  }

  getPayOutList() async {
    try {
      Map map = {
        "owner_id": getData.read("StoreLogin")["id"],
      };
      Uri uri = Uri.parse(AppUrl.path + AppUrl.payoutlist);
      var response = await http.post(
        uri,
        body: jsonEncode(map),
      );
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        payoutInfo = Payoutinfo.fromJson(result);
      }
      isLoading = true;
      update();
    } catch (e) {
      print(e.toString());
    }
  }

  emptyDetails() {
    amount.text = "";
    accountNumber.text = "";
    bankName.text = "";
    accountHolderName.text = "";
    ifscCode.text = "";
    upi.text = "";
    emailId.text = "";
    update();
  }

  requestWithdraweApi({String? rType}) async {
    try {
      Map map = {
        "owner_id": getData.read("StoreLogin")["id"],
        "amt": amount.text,
        "r_type": rType,
        "acc_number": accountNumber.text,
        "bank_name": bankName.text,
        "acc_name": accountHolderName.text,
        "ifsc_code": ifscCode.text,
        "upi_id": upi.text,
        "paypal_id": emailId.text,
      };
      print(map.toString());
      Uri uri = Uri.parse(AppUrl.path + AppUrl.requestwithdraw);
      var response = await http.post(
        uri,
        body: jsonEncode(map),
      );
      print("::==========-------->>" + response.body);
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        print(result.toString());
        if (result["Result"] == "true") {
          emptyDetails();
          getPayOutList();
          Get.back();
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        }
      }
    } catch (e) {
      print(e.toString());
    }
  }
}
