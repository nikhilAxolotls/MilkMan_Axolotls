// ignore_for_file: avoid_print, unused_local_variable, prefer_interpolation_to_compose_strings

import 'dart:convert';

import 'package:get/get_state_manager/get_state_manager.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/Modal_class/trems_condition_model.dart';
import 'package:storeappnew/api_screens/confrigation.dart';

class PageListController extends GetxController implements GetxService {
  DynamicPageData? dynamicPageData;
  bool isLodding = false;

  PageListController() {
    getPageListData();
  }

  getPageListData() async {
    try {
      Uri uri = Uri.parse(AppUrl.path + AppUrl.pagelist);
      var response = await http.post(uri);
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        print(result.toString());
        dynamicPageData = DynamicPageData.fromJson(result);
        isLodding = true;
        update();
      }
    } catch (e) {
      print(e.toString());
    }
  }
}
