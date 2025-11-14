// ignore_for_file: avoid_print, prefer_interpolation_to_compose_strings

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Modal_class/delivery_info.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';
import 'package:http/http.dart' as http;

class AddDeliveryController extends GetxController implements GetxService {
  List<DeliveryInfo> deliveryInfo = [];

  bool isLoading = false;

  TextEditingController deliveriesTitle = TextEditingController();
  TextEditingController deliveriesDegit = TextEditingController();

  String status = "";
  String recodeId = "";

  getValueInDeliveryList({
    String? reId,
    deliveryTitle,
    deliveryDigit,
    status1,
  }) {
    recodeId = reId ?? "";
    deliveriesTitle.text = deliveryTitle ?? "";
    deliveriesDegit.text = deliveryDigit ?? "";
    status = status1 ?? "";
    update();
  }

  emptyValue() {
    deliveriesTitle.text = "";
    deliveriesDegit.text = "";
    recodeId = "";
    status = "";
  }

  getDeliveryList() async {
    try {
      isLoading = false;
      Map map = {
        "store_id": getData.read("StoreLogin")["id"],
      };
      Uri uri = Uri.parse(AppUrl.path + AppUrl.listOfDelivery);
      var response = await http.post(
        uri,
        body: jsonEncode(map),
      );
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        deliveryInfo = [];
        for (var element in result["DeliveriesData"]) {
          deliveryInfo.add(DeliveryInfo.fromJson(element));
        }
        print("--------->>" + result.toString());
      }
      isLoading = true;
      update();
    } catch (e) {
      print(e.toString());
    }
  }

  addDeliveries() async {
    try {
      isLoading = false;
      Map map = {
        "title": deliveriesTitle.text,
        "day": deliveriesDegit.text,
        "status": status != "" ? status : "1",
        "store_id": getData.read("StoreLogin")["id"],
      };
      print(".............(Map)..........." + map.toString());
      Uri uri = Uri.parse(AppUrl.path + AppUrl.addDeliveries);
      var response = await http.post(
        uri,
        body: jsonEncode(map),
      );
      print(".............(Response)..........." + response.body.toString());
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        if (result["Result"] == "true") {
          getDeliveryList();
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        }
      }
      Get.back();
      isLoading = true;
      update();
    } catch (e) {
      print(e.toString());
    }
  }

  editDeliveries() async {
    try {
      isLoading = false;
      Map map = {
        "title": deliveriesTitle.text,
        "day": deliveriesDegit.text,
        "status": status != "" ? status : "1",
        "store_id": getData.read("StoreLogin")["id"],
        "record_id": recodeId,
      };

      Uri uri = Uri.parse(AppUrl.path + AppUrl.updateDeliveries);
      var response = await http.post(
        uri,
        body: jsonEncode(map),
      );
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        if (result["Result"] == "true") {
          getDeliveryList();
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        }
      }
      Get.back();
      isLoading = true;
      update();
    } catch (e) {
      print(e.toString());
    }
  }
}
