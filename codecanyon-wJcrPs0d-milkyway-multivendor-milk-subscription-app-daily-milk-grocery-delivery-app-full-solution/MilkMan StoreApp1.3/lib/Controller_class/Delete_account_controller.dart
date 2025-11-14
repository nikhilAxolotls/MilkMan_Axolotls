// ignore_for_file: avoid_print, file_names

import 'package:get/get.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class DeleteAccountController extends GetxController {
  bool isLoading = false;
  deleteaccount({String? cuisineid}) {
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
    };
    ApiWrapper.dataPost(AppUrl.accdelete, data).then((val) {
      print("===============accountdelete====================" "$val");
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
