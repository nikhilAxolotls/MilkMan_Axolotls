// To parse this JSON data, do
//
//     final payoutinfo = payoutinfoFromJson(jsonString);

// ignore_for_file: file_names

import 'dart:convert';

Payoutinfo payoutinfoFromJson(String str) =>
    Payoutinfo.fromJson(json.decode(str));

String payoutinfoToJson(Payoutinfo data) => json.encode(data.toJson());

class Payoutinfo {
  Payoutinfo({
    required this.responseCode,
    required this.result,
    required this.responseMsg,
    required this.payoutlist,
  });

  String responseCode;
  String result;
  String responseMsg;
  List<Payoutlist> payoutlist;

  factory Payoutinfo.fromJson(Map<String, dynamic> json) => Payoutinfo(
        responseCode: json["ResponseCode"],
        result: json["Result"],
        responseMsg: json["ResponseMsg"],
        payoutlist: List<Payoutlist>.from(
            json["Payoutlist"].map((x) => Payoutlist.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "ResponseCode": responseCode,
        "Result": result,
        "ResponseMsg": responseMsg,
        "Payoutlist": List<dynamic>.from(payoutlist.map((x) => x.toJson())),
      };
}

class Payoutlist {
  Payoutlist({
    required this.payoutId,
    required this.amt,
    required this.status,
    required this.proof,
    required this.rDate,
    required this.rType,
    required this.accNumber,
    required this.bankName,
    required this.accName,
    required this.ifscCode,
    required this.upiId,
    required this.paypalId,
  });

  String payoutId;
  String amt;
  String status;
  String proof;
  DateTime rDate;
  String rType;
  String accNumber;
  String bankName;
  String accName;
  String ifscCode;
  String upiId;
  String paypalId;

  factory Payoutlist.fromJson(Map<String, dynamic> json) => Payoutlist(
        payoutId: json["payout_id"].toString(),
        amt: json["amt"].toString(),
        status: json["status"].toString(),
        proof: json["proof"].toString(),
        rDate: DateTime.parse(json["r_date"]),
        rType: json["r_type"],
        accNumber: json["acc_number"].toString(),
        bankName: json["bank_name"].toString(),
        accName: json["acc_name"].toString(),
        ifscCode: json["ifsc_code"].toString(),
        upiId: json["upi_id"].toString(),
        paypalId: json["paypal_id"].toString(),
      );

  Map<String, dynamic> toJson() => {
        "payout_id": payoutId,
        "amt": amt,
        "status": status,
        "proof": proof,
        "r_date": rDate.toIso8601String(),
        "r_type": rType,
        "acc_number": accNumber,
        "bank_name": bankName,
        "acc_name": accName,
        "ifsc_code": ifscCode,
        "upi_id": upiId,
        "paypal_id": paypalId,
      };
}
