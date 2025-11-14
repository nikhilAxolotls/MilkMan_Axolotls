// ignore_for_file: file_names, avoid_print

import 'package:get/get.dart';
import 'package:storeappnew/Modal_class/My_medicine_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class MymedicineController extends GetxController {
  bool isLoading = false;
  int currentindex = 0;

  Medicinedata? medicinedata;
  List<String> medicinelist = [];
  List<String> price = [];

  mymedicine() {
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
    };
    ApiWrapper.dataPost(AppUrl.productList, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          medicinelist = [];
          for (var element in val["productdata"]) {
            medicinelist.add(element["title"]);
          }
          medicinedata = Medicinedata.fromJson(val);
          isLoading = true;
          update();
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        update();
      }
    });
  }
}
