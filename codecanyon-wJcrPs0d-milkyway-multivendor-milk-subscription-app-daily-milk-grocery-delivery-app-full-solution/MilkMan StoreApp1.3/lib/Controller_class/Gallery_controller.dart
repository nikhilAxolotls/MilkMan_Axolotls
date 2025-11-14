// ignore_for_file: file_names, avoid_print

import 'package:get/get.dart';
import 'package:storeappnew/Modal_class/Gallery_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class GalleyViewController extends GetxController {
  bool isLoading = false;
  int currentindex = 0;

  Galleryinfo? galleryinfo;

  String storeid = "";
  String catName = "";
  String status = "";

  getIdAndName({String? recId, categoryName}) {
    storeid = recId ?? "";
    catName = categoryName ?? "";
  }

  viewgalley() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
    };
    ApiWrapper.dataPost(AppUrl.viewgalley, data).then((val) {
      if ((val != null) && (val.isNotEmpty)) {
        if ((val['ResponseCode'] == "200") && (val['Result'] == "true")) {
          galleryinfo = Galleryinfo.fromJson(val);
        } else {
          ApiWrapper.showToastMessage(val["ResponseMsg"]);
        }
        isLoading = true;
        update();
      }
    });
  }
}
