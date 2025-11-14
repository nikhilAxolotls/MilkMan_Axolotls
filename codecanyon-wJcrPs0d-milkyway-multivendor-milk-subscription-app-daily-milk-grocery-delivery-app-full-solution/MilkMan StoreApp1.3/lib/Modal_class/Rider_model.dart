// To parse this JSON data, do
//
//     final riderlist = riderlistFromJson(jsonString);

// ignore_for_file: file_names

import 'dart:convert';

Riderlist riderlistFromJson(String str) => Riderlist.fromJson(json.decode(str));

String riderlistToJson(Riderlist data) => json.encode(data.toJson());

class Riderlist {
  Riderlist({
    required this.riderdata,
    required this.responseCode,
    required this.result,
    required this.responseMsg,
  });

  List<Riderdatum> riderdata;
  String responseCode;
  String result;
  String responseMsg;

  factory Riderlist.fromJson(Map<String, dynamic> json) => Riderlist(
        riderdata: List<Riderdatum>.from(
            json["riderdata"].map((x) => Riderdatum.fromJson(x))),
        responseCode: json["ResponseCode"],
        result: json["Result"],
        responseMsg: json["ResponseMsg"],
      );

  Map<String, dynamic> toJson() => {
        "riderdata": List<dynamic>.from(riderdata.map((x) => x.toJson())),
        "ResponseCode": responseCode,
        "Result": result,
        "ResponseMsg": responseMsg,
      };
}

class Riderdatum {
  Riderdatum({
    required this.id,
    required this.storeId,
    required this.img,
    required this.title,
    required this.email,
    required this.ccode,
    required this.mobile,
    required this.password,
    required this.rdate,
    required this.status,
  });

  String id;
  String storeId;
  String img;
  String title;
  String email;
  String ccode;
  String mobile;
  String password;
  DateTime rdate;
  String status;

  factory Riderdatum.fromJson(Map<String, dynamic> json) => Riderdatum(
        id: json["id"],
        storeId: json["store_id"],
        img: json["img"],
        title: json["title"],
        email: json["email"],
        ccode: json["ccode"],
        mobile: json["mobile"],
        password: json["password"],
        rdate: DateTime.parse(json["rdate"]),
        status: json["status"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "store_id": storeId,
        "img": img,
        "title": title,
        "email": email,
        "ccode": ccode,
        "mobile": mobile,
        "password": password,
        "rdate":
            "${rdate.year.toString().padLeft(4, '0')}-${rdate.month.toString().padLeft(2, '0')}-${rdate.day.toString().padLeft(2, '0')}",
        "status": status,
      };
}
