// ignore_for_file: file_names, avoid_print, unused_import

import 'package:get/get.dart';
import 'package:storeappnew/Modal_class/Category_model.dart';
import 'package:storeappnew/Modal_class/Extra_image_model.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class ExtraimageController extends GetxController {
  bool isLoading = false;
  int currentindex = 0;

  Extraimage? extraimages;

  String storeid = "";
  String catName = "";
  String status = "";

  getIdAndName({String? recId, categoryName}) {
    storeid = recId ?? "";
    catName = categoryName ?? "";
  }

  extraimage() {
    isLoading = false;
    var data = {
      "store_id": getData.read("StoreLogin")["id"],
    };
    ApiWrapper.dataPost(AppUrl.extraimagelist, data).then((val) {
      if ((val['ResponseCode'] == "200")) {
        extraimages = Extraimage.fromJson(val);
      } else {
        ApiWrapper.showToastMessage(val["ResponseMsg"]);
      }
      isLoading = true;
      update();
    });
  }
}
