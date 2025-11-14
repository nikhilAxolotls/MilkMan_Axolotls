// To parse this JSON data, do
//
//     final timesloatinfo = timesloatinfoFromJson(jsonString);

// ignore_for_file: file_names

import 'dart:convert';

Timesloatinfo timesloatinfoFromJson(String str) =>
    Timesloatinfo.fromJson(json.decode(str));

String timesloatinfoToJson(Timesloatinfo data) => json.encode(data.toJson());

class Timesloatinfo {
  Timesloatinfo({
    required this.gallerydata,
    required this.responseCode,
    required this.result,
    required this.responseMsg,
  });

  List<Gallerydatum> gallerydata;
  String responseCode;
  String result;
  String responseMsg;

  factory Timesloatinfo.fromJson(Map<String, dynamic> json) => Timesloatinfo(
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
    required this.mintime,
    required this.maxtime,
    required this.status,
  });

  String id;
  String storeId;
  String mintime;
  String maxtime;
  String status;

  factory Gallerydatum.fromJson(Map<String, dynamic> json) => Gallerydatum(
        id: json["id"],
        storeId: json["store_id"],
        mintime: json["mintime"],
        maxtime: json["maxtime"],
        status: json["status"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "store_id": storeId,
        "mintime": mintime,
        "maxtime": maxtime,
        "status": status,
      };
}
