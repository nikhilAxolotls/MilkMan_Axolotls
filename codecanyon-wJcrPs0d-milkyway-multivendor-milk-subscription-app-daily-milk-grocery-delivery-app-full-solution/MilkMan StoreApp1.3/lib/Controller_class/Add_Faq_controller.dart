// ignore_for_file: avoid_print, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, non_constant_identifier_names, unused_import, file_names

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/Controller_class/Category_Controller.dart';
import 'package:storeappnew/Controller_class/Faq_controller.dart';
import 'package:storeappnew/Controller_class/My_medicine_Controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class AddFaqsController extends GetxController implements GetxService {
  FaqsController faqsController = Get.put(FaqsController());

  TextEditingController answer = TextEditingController();
  TextEditingController queation = TextEditingController();

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

  addfaqs() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "status": status != "" ? status : "1",
      "question": queation.text,
      "answer": answer.text
    };
    print("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!$data");
    ApiWrapper.dataPost(AppUrl.addfaq, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          faqsController.faqlist();
          queation.text = "";
          answer.text = "";
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        Get.back();
        isLoading = true;
        update();
      }
    });
  }

  updatefaqs() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "status": status != "" ? status : "1",
      "question": queation.text,
      "answer": answer.text,
      "record_id": recordID
    };
    print("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&$data");
    ApiWrapper.dataPost(AppUrl.updatefaq, data).then((val) {
      print("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&$data");
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
          faqsController.faqlist();
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
