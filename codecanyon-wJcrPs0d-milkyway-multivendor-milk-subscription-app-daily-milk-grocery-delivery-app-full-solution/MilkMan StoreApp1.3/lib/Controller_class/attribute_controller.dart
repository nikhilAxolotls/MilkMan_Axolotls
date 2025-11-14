// ignore_for_file: avoid_print, prefer_interpolation_to_compose_strings

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:storeappnew/Modal_class/attri_info.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class AttributeController extends GetxController implements GetxService {
  bool isLoading = false;
  AttriInfo? attriInfo;

  TextEditingController productType = TextEditingController();
  TextEditingController productDiscount = TextEditingController();
  TextEditingController productPrice = TextEditingController();
  TextEditingController productSPrice = TextEditingController();

  String pType = "";
  String status = "";
  String status1 = "";
  String recodeID = "";

  emptyValue() {
    pType = "";
    status = "";
    status1 = "";
    productType.text = "";
    productDiscount.text = "";
    productPrice.text = "";
    productSPrice.text = "";
  }

  getValueInAttribute({
    String? reId,
    productId,
    proType,
    proDiscount,
    proPrice,
    proSPrice,
  }) {
    recodeID = reId ?? "";
    pType = productId ?? "";
    productType.text = proType ?? "";
    productDiscount.text = proDiscount ?? "";
    productPrice.text = proPrice ?? "";
    productSPrice.text = proSPrice ?? "";
    update();
  }

  getAttributeList() async {
    try {
      isLoading = false;
      Map map = {
        "store_id": getData.read("StoreLogin")["id"],
      };
      Uri uri = Uri.parse(AppUrl.path + AppUrl.listOfAttribute);
      var response = await http.post(
        uri,
        body: jsonEncode(map),
      );
      print("+++++++**********++++++++" + response.body);
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        attriInfo = AttriInfo.fromJson(result);
      }
      isLoading = true;
      update();
    } catch (e) {
      print(e.toString());
    }
  }

  addAttributeInProduct() async {
    try {
      isLoading = false;
      Map map = {
        "product_id": pType,
        "mprice": productPrice.text,
        "sprice": productSPrice.text,
        "srequire": status != "" ? status : "1",
        "title": productType.text,
        "mdiscount": productDiscount.text,
        "mstock": status1 != "" ? status1 : "1",
        "store_id": getData.read("StoreLogin")["id"],
      };
// product_id
// mprice
// sprice
// srequire
// title
// mdiscount
// mstock
// store_id

      print(":::::::::::(Map)::::::::::" + map.toString());
      Uri uri = Uri.parse(AppUrl.path + AppUrl.addAttribute);
      var response = await http.post(
        uri,
        body: jsonEncode(map),
      );
      print(":::::::::::(Response)::::::::::" + response.body.toString());
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        if (result["Result"] == "true") {
          getAttributeList();
          emptyValue();
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        }
      }
      Get.back();
      isLoading = true;
      update();
    } catch (e) {
      print(e.toString());
    }
  }

  updateAttributeInProduct() async {
    try {
      isLoading = false;
      Map map = {
        "product_id": pType,
        "mprice": productPrice.text,
        "sprice": productSPrice.text,
        "srequire": status != "" ? status : "1",
        "title": productType.text,
        "mdiscount": productDiscount.text,
        "mstock": status1 != "" ? status1 : "1",
        "store_id": getData.read("StoreLogin")["id"],
        "record_id": recodeID,
      };
// product_id
// mprice
// sprice
// srequire
// title
// mdiscount
// mstock
// store_id
// record_id
      Uri uri = Uri.parse(AppUrl.path + AppUrl.updateAttribute);
      var response = await http.post(
        uri,
        body: jsonEncode(map),
      );
      if (response.statusCode == 200) {
        var result = jsonDecode(response.body);
        if (result["Result"] == "true") {
          getAttributeList();
          emptyValue();
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        } else {
          ApiWrapper.showToastMessage(result["ResponseMsg"]);
        }
      }
      Get.back();
      isLoading = true;
      update();
    } catch (e) {
      print(e.toString());
    }
  }
}
