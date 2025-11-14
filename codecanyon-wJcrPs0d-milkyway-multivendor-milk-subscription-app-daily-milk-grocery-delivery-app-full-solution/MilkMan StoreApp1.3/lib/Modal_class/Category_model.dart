// To parse this JSON data, do
//
//     final categoryinfo = categoryinfoFromJson(jsonString);

// ignore_for_file: file_names

import 'dart:convert';

Categoryinfo categoryinfoFromJson(String str) =>
    Categoryinfo.fromJson(json.decode(str));

String categoryinfoToJson(Categoryinfo data) => json.encode(data.toJson());

class Categoryinfo {
  List<Categorydatum> categorydata;
  String responseCode;
  String result;
  String responseMsg;

  Categoryinfo({
    required this.categorydata,
    required this.responseCode,
    required this.result,
    required this.responseMsg,
  });

  factory Categoryinfo.fromJson(Map<String, dynamic> json) => Categoryinfo(
        categorydata: List<Categorydatum>.from(
            json["categorydata"].map((x) => Categorydatum.fromJson(x))),
        responseCode: json["ResponseCode"],
        result: json["Result"],
        responseMsg: json["ResponseMsg"],
      );

  Map<String, dynamic> toJson() => {
        "categorydata": List<dynamic>.from(categorydata.map((x) => x.toJson())),
        "ResponseCode": responseCode,
        "Result": result,
        "ResponseMsg": responseMsg,
      };
}

class Categorydatum {
  String id;
  String storeId;
  String title;
  String status;
  String img;

  Categorydatum({
    required this.id,
    required this.storeId,
    required this.title,
    required this.status,
    required this.img,
  });

  factory Categorydatum.fromJson(Map<String, dynamic> json) => Categorydatum(
        id: json["id"],
        storeId: json["store_id"],
        title: json["title"],
        status: json["status"],
        img: json["img"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "store_id": storeId,
        "title": title,
        "status": status,
        "img": img,
      };
}
