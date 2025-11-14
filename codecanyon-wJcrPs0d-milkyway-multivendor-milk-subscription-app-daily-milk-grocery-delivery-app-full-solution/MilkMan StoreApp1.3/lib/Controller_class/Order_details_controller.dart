// ignore_for_file: file_names, avoid_print, unused_import, non_constant_identifier_names, prefer_interpolation_to_compose_strings

import 'package:get/get.dart';
import 'package:storeappnew/Modal_class/Category_model.dart';
import 'package:storeappnew/Modal_class/Faq_model.dart';
import 'package:storeappnew/Modal_class/Order_details_model.dart';
import 'package:storeappnew/Modal_class/Order_history_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class OrderdetailController extends GetxController {
  bool isLoading = false;
  Orderdetailsinfo? orderdetailsinfo;

  String storeid = "";
  String catName = "";

  int currentIndex = 0;

  changeIndexProductWise({int? index}) {
    currentIndex = index ?? 0;
    update();
  }

  orderdetailslist({String? oid}) {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
      // "store_id": "1",
      "order_id": oid,
    };
    print("*/*/*/*/*/*/*/*/*/*/*/*/*/****>>" + data.toString());
    ApiWrapper.dataPost(AppUrl.orderdetails, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          orderdetailsinfo = Orderdetailsinfo.fromJson(val);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }
}
