// ignore_for_file: file_names, avoid_print, prefer_interpolation_to_compose_strings

import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Subscription_history_controller.dart';
import 'package:storeappnew/Modal_class/Rider_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class PrescriptiondetailsController extends GetxController {
  bool isLoading = false;
  int currentindex = 0;

  PrescriptionhistoryController prescriptionhistoryController =
      Get.put(PrescriptionhistoryController());

  List<String> ridertitle = [];
  Riderlist? riderinfo;

  assignriderlist({String? oid, rid}) {
    var data = {"oid": oid, "rid": rid};
    ApiWrapper.dataPost(AppUrl.assignrider, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          isLoading = true;
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        update();
      }
    });
  }

  ordercompletedlist({String? oid}) {
    var data = {"order_id": oid, "store_id": getData.read("StoreLogin")["id"]};
    ApiWrapper.dataPost(AppUrl.completeorder, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          isLoading = true;
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        update();
      }
    });
  }

  prescriptiondecision({
    String? oid,
  }) {
    var data = {"oid": oid, "status": "1", "comment_reject": "n/a"};
    ApiWrapper.dataPost(AppUrl.prescriptiondecision, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          prescriptionhistoryController.prescriptidetailslist(oid: oid);
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }

  prescriptioncancle({String? oid, reason}) {
    var data = {"oid": oid, "status": "2", "comment_reject": reason};
    ApiWrapper.dataPost(AppUrl.prescriptiondecision, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }
}
