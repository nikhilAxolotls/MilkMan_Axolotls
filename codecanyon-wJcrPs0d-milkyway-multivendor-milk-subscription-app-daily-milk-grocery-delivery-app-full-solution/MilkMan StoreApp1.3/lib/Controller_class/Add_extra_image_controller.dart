// ignore_for_file: avoid_print, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, non_constant_identifier_names, unused_import, file_names

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/Controller_class/Category_Controller.dart';
import 'package:storeappnew/Controller_class/Extra_image_controller.dart';
import 'package:storeappnew/Controller_class/Faq_controller.dart';
import 'package:storeappnew/Controller_class/My_medicine_Controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class AddExtraimageController extends GetxController implements GetxService {
  ExtraimageController extraimageController = Get.put(ExtraimageController());

  TextEditingController answer = TextEditingController();
  TextEditingController queation = TextEditingController();

  String? path;
  String? base64Image;

  String countryId = "";

  String pType = "";
  String pbuySell = "";
  String status = "";

  String medicineImage = "";

  bool isLoading = false;

  String recordID = "";
  String mid = "";
  String answerquestion = "";

  getIdAndName({
    String? recId,
    mid1,
  }) {
    recordID = recId ?? "";
    mid = mid1 ?? "";
    update();
  }

  addextraimage() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "status": status != "" ? status : "1",
      "mid": pType,
      "img": base64Image
    };
    print("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!$data");
    ApiWrapper.dataPost(AppUrl.addextraimage, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          extraimageController.extraimage();
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        Get.back();
        path = null;
        isLoading = true;
        update();
      }
    });
  }

  editExtraimage() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "status": status != "" ? status : "1",
      "mid": pType,
      "img": path != null ? base64Image.toString() : "0",
      "record_id": recordID
    };
    print("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&$data");
    ApiWrapper.dataPost(AppUrl.editExtraimage, data).then((val) {
      print("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&$data");
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          extraimageController.extraimage();
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        Get.back();
        update();
      }
    });
  }
}
