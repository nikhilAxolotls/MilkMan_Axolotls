// ignore_for_file: file_names, avoid_print, prefer_interpolation_to_compose_strings

import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Order_details_controller.dart';
import 'package:storeappnew/Modal_class/Rider_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class AssignriderController extends GetxController {
  bool isLoading = false;
  int currentindex = 0;
  OrderdetailController orderdetailController =
      Get.put(OrderdetailController());

  List<String> ridertitle = [];
  Riderlist? riderinfo;

  assignriderlist({String? oid, rid}) {
    isLoading = false;
    var data = {"oid": oid, "rid": rid};
    ApiWrapper.dataPost(AppUrl.assignrider, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          print("||||||||||||||||||||" + val.toString());

          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }

  ordercompletedlist({String? oid}) {
    isLoading = false;
    var data = {"order_id": oid, "store_id": getData.read("StoreLogin")["id"]};
    ApiWrapper.dataPost(AppUrl.completeorder, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          print("||||||||||||||||||||" + val.toString());
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }

  mackdisitionlist({
    String? oid,
  }) {
    isLoading = false;
    var data = {"oid": oid, "status": "1", "comment_reject": "n/a"};
    ApiWrapper.dataPost(AppUrl.makedecision, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          print("||||||||||||||||||||" + val.toString());
          orderdetailController.orderdetailslist(oid: oid);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }

  mackdisitioncancle({String? oid, reason}) {
    isLoading = false;
    var data = {"oid": oid, "status": "2", "comment_reject": reason};
    ApiWrapper.dataPost(AppUrl.makedecision, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          // riderinfo = Riderlist.fromJson(val);
          print("||||||||||||||||||||" + val.toString());
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
