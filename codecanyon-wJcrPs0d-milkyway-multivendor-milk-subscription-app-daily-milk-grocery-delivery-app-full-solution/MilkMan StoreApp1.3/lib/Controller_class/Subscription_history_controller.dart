// ignore_for_file: file_names, avoid_print, unused_import, non_constant_identifier_names

import 'package:get/get.dart';
import 'package:storeappnew/Modal_class/Category_model.dart';
import 'package:storeappnew/Modal_class/Faq_model.dart';
import 'package:storeappnew/Modal_class/Order_details_model.dart';
import 'package:storeappnew/Modal_class/Order_history_model.dart';
import 'package:storeappnew/Modal_class/Prescription_History_model.dart';
import 'package:storeappnew/Modal_class/pre_details_info_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class PrescriptionhistoryController extends GetxController {
  // Dashboard? dashboard;
  bool isLoading = false;

  Prescriptionorderinfo? prescriptionorderinfo;
  Prescriptiondetailsinfo? prescriptiondetailsinfo;
  int currentIndex = 0;

  String storeid = "";
  String catName = "";

  changeIndexProductWise({int? index}) {
    currentIndex = index ?? 0;
    update();
  }

  Prescriptionhistorylist({String? Status}) {
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      // "store_id": "1",
      "status": Status,
    };
    ApiWrapper.dataPost(AppUrl.prescriptionhistory, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        // if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
        prescriptionorderinfo = Prescriptionorderinfo.fromJson(val);
        // } else {
        // ApiWrapper.showToastMessage(val["ResponseMsg"]);
        // }
        isLoading = true;
        update();
      }
    });
  }

  prescriptidetailslist({String? oid}) {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      // "store_id": "1",
      "order_id": oid,
    };
    ApiWrapper.dataPost(AppUrl.subScriptioninfo, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          print("%%%%%%%%%%%%%%%%%%%%%%%${val.toString()}");
          prescriptiondetailsinfo = Prescriptiondetailsinfo.fromJson(val);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }
}
