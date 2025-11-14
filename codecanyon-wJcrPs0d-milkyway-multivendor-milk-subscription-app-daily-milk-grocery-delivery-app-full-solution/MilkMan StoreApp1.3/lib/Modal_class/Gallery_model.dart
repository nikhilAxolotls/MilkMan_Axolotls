// To parse this JSON data, do
//
//     final galleryinfo = galleryinfoFromJson(jsonString);

// ignore_for_file: file_names

import 'dart:convert';

Galleryinfo galleryinfoFromJson(String str) =>
    Galleryinfo.fromJson(json.decode(str));

String galleryinfoToJson(Galleryinfo data) => json.encode(data.toJson());

class Galleryinfo {
  Galleryinfo({
    required this.gallerydata,
    required this.responseCode,
    required this.result,
    required this.responseMsg,
  });

  List<Gallerydatum> gallerydata;
  String responseCode;
  String result;
  String responseMsg;

  factory Galleryinfo.fromJson(Map<String, dynamic> json) => Galleryinfo(
        gallerydata: List<Gallerydatum>.from(
            json["gallerydata"].map((x) => Gallerydatum.fromJson(x))),
        responseCode: json["ResponseCode"],
        result: json["Result"],
        responseMsg: json["ResponseMsg"],
      );

  Map<String, dynamic> toJson() => {
        "gallerydata": List<dynamic>.from(gallerydata.map((x) => x.toJson())),
        "ResponseCode": responseCode,
        "Result": result,
        "ResponseMsg": responseMsg,
      };
}

class Gallerydatum {
  Gallerydatum({
    required this.id,
    required this.storeId,
    required this.img,
    required this.status,
  });

  String id;
  String storeId;
  String img;
  String status;

  factory Gallerydatum.fromJson(Map<String, dynamic> json) => Gallerydatum(
        id: json["id"],
        storeId: json["store_id"],
        img: json["img"],
        status: json["status"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "store_id": storeId,
        "img": img,
        "status": status,
      };
}
