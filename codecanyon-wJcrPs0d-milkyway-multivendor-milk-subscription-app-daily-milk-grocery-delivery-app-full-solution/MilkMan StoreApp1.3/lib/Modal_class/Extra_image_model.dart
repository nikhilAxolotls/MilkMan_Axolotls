// To parse this JSON data, do
//
//     final extraimage = extraimageFromJson(jsonString);

// ignore_for_file: file_names

import 'dart:convert';

Extraimage extraimageFromJson(String str) =>
    Extraimage.fromJson(json.decode(str));

String extraimageToJson(Extraimage data) => json.encode(data.toJson());

class Extraimage {
  Extraimage({
    required this.extralist,
    required this.responseCode,
    required this.result,
    required this.responseMsg,
  });

  List<Extralist> extralist;
  String responseCode;
  String result;
  String responseMsg;

  factory Extraimage.fromJson(Map<String, dynamic> json) => Extraimage(
        extralist: List<Extralist>.from(
            json["extralist"].map((x) => Extralist.fromJson(x))),
        responseCode: json["ResponseCode"],
        result: json["Result"],
        responseMsg: json["ResponseMsg"],
      );

  Map<String, dynamic> toJson() => {
        "extralist": List<dynamic>.from(extralist.map((x) => x.toJson())),
        "ResponseCode": responseCode,
        "Result": result,
        "ResponseMsg": responseMsg,
      };
}

class Extralist {
  Extralist({
    required this.id,
    required this.medicineTitle,
    required this.medicineId,
    required this.image,
    required this.status,
  });

  String id;
  String medicineTitle;
  String medicineId;
  String image;
  String status;

  factory Extralist.fromJson(Map<String, dynamic> json) => Extralist(
        id: json["id"],
        medicineTitle: json["medicine_title"],
        medicineId: json["medicine_id"],
        image: json["image"],
        status: json["status"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "medicine_title": medicineTitle,
        "medicine_id": medicineId,
        "image": image,
        "status": status,
      };
}
