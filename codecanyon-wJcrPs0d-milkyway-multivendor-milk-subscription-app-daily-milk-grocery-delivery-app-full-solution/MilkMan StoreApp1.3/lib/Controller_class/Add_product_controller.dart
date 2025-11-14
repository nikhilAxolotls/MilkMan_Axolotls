// ignore_for_file: avoid_print, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, non_constant_identifier_names, unused_import, file_names

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/Controller_class/My_medicine_Controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class AddmedicineController extends GetxController implements GetxService {
  MymedicineController mymedicineController = Get.put(MymedicineController());

  TextEditingController MedicineTitle = TextEditingController();
  TextEditingController description = TextEditingController();
  // TextEditingController disclaimer = TextEditingController();
  // TextEditingController aprice = TextEditingController();
  // TextEditingController sprice = TextEditingController();
  // TextEditingController qlimit = TextEditingController();

  String? path;
  String? base64Image;

  String countryId = "";

  String pType = "";
  String pbuySell = "";
  String status = "";

  String medicineImage = "";

  var selectedIndexes = [];

  var lat;
  var long;

  String Editimage = "";
  String Edittitle = "";
  String Editactualprice = "";
  String Editdiscountprice = "";
  String Editquantityprice = "";
  String Editprescription = "";
  String Editcategory = "";
  String EditDescription = "";
  String Editdisclaimer = "";
  String Editstatus = "";

  var elat;
  var elong;
  bool isLoading = false;
  getEditDetails(
      {String? etitle,
      eimage,
      eactualprice,
      ediscountprice,
      equantityprice,
      eprescription,
      ecategory,
      edescription,
      edisclaimer,
      estatus}) {
    Editimage = eimage ?? "";
    Edittitle = etitle ?? "";
    Editactualprice = eactualprice ?? "";
    Editdiscountprice = ediscountprice ?? "";
    Editquantityprice = equantityprice ?? "";
    Editprescription = eprescription ?? "";
    Editcategory = ecategory ?? "";
    EditDescription = edescription ?? "";
    Editdisclaimer = edisclaimer ?? "";
    Editstatus = estatus ?? "";

    update();
  }

  getCurrentLatAndLong(double latitude, double longitude) {
    lat = latitude;
    long = longitude;
    update();
  }

  emptyAllDetails() {
    MedicineTitle.text = "";
    description.text = "";
    // disclaimer.text = "";
    // aprice.text = "";
    // sprice.text = "";
    // qlimit.text = "";
    pType = "";
    path = null;
    base64Image = "";
    status = "";
    medicineImage = "";
    update();
  }

  addmedicine() {
    isLoading = false;
    var data = {
      "status": status != "" ? status : "1",
      "store_id": getData.read("StoreLogin")["id"],
      "description": description.text,
      "title": MedicineTitle.text,
      "cat_id": pType,
      "img": base64Image,
    };
    print("*************------->>$data");
    ApiWrapper.dataPost(AppUrl.addProduct, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        print("......../Response/........" + val.toString());
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          mymedicineController.mymedicine();
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

  updatemedicine({String? recordid}) {
    isLoading = false;
    var data = {
      "status": status != "" ? status : "1",
      "store_id": getData.read("StoreLogin")["id"],
      "description": description.text,
      "title": MedicineTitle.text,
      "cat_id": pType,
      "img": path != null ? base64Image : "0",
      "record_id": recordid
    };
    print("*************------->>$data");
    ApiWrapper.dataPost(AppUrl.updateProduct, data).then((val) {
      print("......../Response/........" + val.toString());
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
          mymedicineController.mymedicine();
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        Get.back();
        isLoading = true;
        update();
      }
    });
  }
}
