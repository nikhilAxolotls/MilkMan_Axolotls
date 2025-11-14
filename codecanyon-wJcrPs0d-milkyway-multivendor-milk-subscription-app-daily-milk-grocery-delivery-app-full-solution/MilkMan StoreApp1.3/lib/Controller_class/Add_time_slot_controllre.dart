// ignore_for_file: avoid_print, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, non_constant_identifier_names, unused_import, file_names

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/Controller_class/Category_Controller.dart';
import 'package:storeappnew/Controller_class/Faq_controller.dart';
import 'package:storeappnew/Controller_class/My_medicine_Controller.dart';
import 'package:storeappnew/Controller_class/Time_slot_controllre.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class AddTimeSlotController extends GetxController implements GetxService {
  TimeslotController timeslotController = Get.put(TimeslotController());

  TextEditingController mintime = TextEditingController();
  TextEditingController maxtime = TextEditingController();

  bool isLoading = false;
  String pType = "";
  String status = "";

  String recordID = "";
  String question = "";
  String answerquestion = "";

  getIdAndName({String? recId, qurstionid, answerid}) {
    recordID = recId ?? "";
    question = qurstionid ?? "";
    answerquestion = answerid ?? "";
    update();
  }

  addtimeslot() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "status": status != "" ? status : "1",
      "mintime": mintime.text.split(" ").first,
      "maxtime": maxtime.text.split(" ").first
    };
    print("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!$data");
    ApiWrapper.dataPost(AppUrl.addtimeslot, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          timeslotController.timeslot();
          mintime.text = "";
          maxtime.text = "";
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        Get.back();
        isLoading = true;
        update();
      }
    });
  }

  updatetimeslot() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "status": status != "" ? status : "1",
      "mintime": mintime.text.split(" ").first,
      "maxtime": maxtime.text.split(" ").first,
      "record_id": recordID
    };
    print("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&$data");
    ApiWrapper.dataPost(AppUrl.updatetimeslot, data).then((val) {
      print("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&$data");
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          timeslotController.timeslot();
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
}
