// To parse this JSON data, do
//
//     final medicinedata = medicinedataFromJson(jsonString);

// ignore_for_file: file_names

import 'dart:convert';

Medicinedata medicinedataFromJson(String str) =>
    Medicinedata.fromJson(json.decode(str));

String medicinedataToJson(Medicinedata data) => json.encode(data.toJson());

class Medicinedata {
  List<Productdatum> productdata;
  String responseCode;
  String result;
  String responseMsg;

  Medicinedata({
    required this.productdata,
    required this.responseCode,
    required this.result,
    required this.responseMsg,
  });

  factory Medicinedata.fromJson(Map<String, dynamic> json) => Medicinedata(
        productdata: List<Productdatum>.from(
            json["productdata"].map((x) => Productdatum.fromJson(x))),
        responseCode: json["ResponseCode"],
        result: json["Result"],
        responseMsg: json["ResponseMsg"],
      );

  Map<String, dynamic> toJson() => {
        "productdata": List<dynamic>.from(productdata.map((x) => x.toJson())),
        "ResponseCode": responseCode,
        "Result": result,
        "ResponseMsg": responseMsg,
      };
}

class Productdatum {
  String id;
  String storeId;
  String catId;
  String catName;
  String title;
  String img;
  String description;
  String status;

  Productdatum({
    required this.id,
    required this.storeId,
    required this.catId,
    required this.catName,
    required this.title,
    required this.img,
    required this.description,
    required this.status,
  });

  factory Productdatum.fromJson(Map<String, dynamic> json) => Productdatum(
        id: json["id"],
        storeId: json["store_id"],
        catId: json["cat_id"],
        catName: json["cat_name"],
        title: json["title"],
        img: json["img"],
        description: json["description"],
        status: json["status"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "store_id": storeId,
        "cat_id": catId,
        "cat_name": catName,
        "title": title,
        "img": img,
        "description": description,
        "status": status,
      };
}
