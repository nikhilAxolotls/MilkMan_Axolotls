// ignore_for_file: file_names, avoid_print

import 'package:get/get.dart';
import 'package:storeappnew/Modal_class/Coupon_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class CouponlistController extends GetxController {
  bool isLoading = false;
  int currentindex = 0;

  List dashboardlist = [];
  Coupondatainfo? coupondatainfo;

  couponlist() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
    };
    ApiWrapper.dataPost(AppUrl.couponlist, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          coupondatainfo = Coupondatainfo.fromJson(val);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }
}
