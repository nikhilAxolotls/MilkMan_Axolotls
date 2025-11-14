// ignore_for_file: avoid_print, prefer_interpolation_to_compose_strings, file_names

import 'dart:convert';

import 'package:get/get_state_manager/get_state_manager.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/Modal_class/Notification_model.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class NotificationController extends GetxController implements GetxService {
  NotificationInfo? notificationInfo;
  bool isLoading = false;

  NotificationController() {
    getNotificationData();
  }

  getNotificationData() async {
    try {
      Map map = {
        "store_id": getData.read("StoreLogin")["id"].toString(),
      };
      print(map.toString());
      Uri uri = Uri.parse(AppUrl.path + AppUrl.notification);
      var response = await http.post(
        uri,
        body: jsonEncode(map),
      );
      print("{{{{{{{{{{{{{{${response.body}");
      print(response.body);
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        print("0000000000000000" + result.toString());
        notificationInfo = NotificationInfo.fromJson(result);
      }
      isLoading = true;
      update();
    } catch (e) {
      print(e.toString());
    }
  }
}
