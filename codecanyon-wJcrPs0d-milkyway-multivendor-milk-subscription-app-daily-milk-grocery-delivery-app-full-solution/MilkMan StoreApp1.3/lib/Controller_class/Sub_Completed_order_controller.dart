// ignore_for_file: file_names, avoid_print

import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Subscription_history_controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class PrecompletedorderController extends GetxController {
  bool isLoading = false;
  int currentindex = 0;

  PrescriptionhistoryController prescriptionhistoryController =
      Get.put(PrescriptionhistoryController());

  precompletedorder({String? orderid}) {
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      "order_id": orderid,
    };
    ApiWrapper.dataPost(AppUrl.precomplete, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
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

  preassign({String? orderid, riderid}) {
    var data = {
      "order_id": orderid,
      "rid": riderid,
    };
    ApiWrapper.dataPost(AppUrl.preassign, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          prescriptionhistoryController.prescriptidetailslist(oid: orderid);
          prescriptionhistoryController.Prescriptionhistorylist(
              Status: "Current");
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
