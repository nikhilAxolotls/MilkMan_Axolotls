// ignore_for_file: file_names, avoid_print, unused_import, non_constant_identifier_names, prefer_interpolation_to_compose_strings

import 'package:get/get.dart';
import 'package:storeappnew/Modal_class/Category_model.dart';
import 'package:storeappnew/Modal_class/Faq_model.dart';
import 'package:storeappnew/Modal_class/Order_history_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class OrderhistoryController extends GetxController {
  bool isLoading = false;

  Orderhistoryinfo? orderhistoryinfo;

  String storeid = "";
  String catName = "";

  orderhistorylist({String? Status}) {
    var data = {
      // "store_id": "1",
      "store_id": getData.read("StoreLogin")["id"],
      "status": Status,
    };
    print("*/*/*/*/*/*/*/*/*/*/*/*/*/****>>" + data.toString());
    ApiWrapper.dataPost(AppUrl.orderhistory, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        // if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
        orderhistoryinfo = Orderhistoryinfo.fromJson(val);
        // } else {
        // ApiWrapper.showToastMessage(val["ResponseMsg"]);
        // }
        isLoading = true;
        update();
      }
    });
  }
}
