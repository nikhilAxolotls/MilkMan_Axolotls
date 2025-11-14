// ignore_for_file: avoid_print, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, non_constant_identifier_names, unused_import, file_names

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/Controller_class/Category_Controller.dart';
import 'package:storeappnew/Controller_class/My_medicine_Controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class AddcategoryController extends GetxController implements GetxService {
  CategoryController categoryController = Get.put(CategoryController());

  TextEditingController categoryname = TextEditingController();

  bool isLoading = false;
  String pType = "";
  String status = "";

  String? path;
  String? base64Image;
  String productImage = "";

  String mid = "";

  String recordID = "";
  String catName = "";

  getIdAndName({
    String? recId,
    categoryName,
    mid1,
  }) {
    recordID = recId ?? "";
    catName = categoryName ?? "";
    mid = mid1 ?? "";
    update();
  }

  addcategory() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "status": status != "" ? status : "1",
      "title": categoryname.text,
      "img": base64Image,
    };
    print("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!$data");
    ApiWrapper.dataPost(AppUrl.addcategory, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          categoryController.categorylist();
          categoryname.text = "";
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

  updatecategory() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "status": status != "" ? status : "1",
      "title": categoryname.text,
      "img": path != null ? base64Image.toString() : "0",
      "record_id": recordID
    };
    print("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&$data");
    ApiWrapper.dataPost(AppUrl.updatecategory, data).then((val) {
      print("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&$data");
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
          categoryController.categorylist();
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
