// ignore_for_file: file_names, avoid_print, prefer_interpolation_to_compose_strings

import 'package:get/get.dart';
// import 'package:storeappnew/Modal_class/Deshboard_Model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class DashboardController extends GetxController {
  bool isLoading = false;
  int currentindex = 0;
  String withdrawlimit = "";

  List dashboardlist = [];

  String earningamount = "";

  deshboard() {
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
    };
    ApiWrapper.dataPost(AppUrl.dashboard, data).then((val) {
      print("||||||||||+++++++++++" + val.toString());
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          for (var element in val["report_data"]) {
            if (element["title"] == "Earning") {
              earningamount = element["report_data"].toString();
            }
          }
          dashboardlist = val["report_data"];
          withdrawlimit = val["withdraw_limit"];
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }
}
