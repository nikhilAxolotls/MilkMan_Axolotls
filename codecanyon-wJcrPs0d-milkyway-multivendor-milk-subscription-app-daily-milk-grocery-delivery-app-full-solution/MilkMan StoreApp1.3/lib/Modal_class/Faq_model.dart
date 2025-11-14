// To parse this JSON data, do
//
//     final faqinfo = faqinfoFromJson(jsonString);

// ignore_for_file: file_names

import 'dart:convert';

Faqinfo faqinfoFromJson(String str) => Faqinfo.fromJson(json.decode(str));

String faqinfoToJson(Faqinfo data) => json.encode(data.toJson());

class Faqinfo {
  Faqinfo({
    required this.faQdata,
    required this.responseCode,
    required this.result,
    required this.responseMsg,
  });

  List<FaQdatum> faQdata;
  String responseCode;
  String result;
  String responseMsg;

  factory Faqinfo.fromJson(Map<String, dynamic> json) => Faqinfo(
        faQdata: List<FaQdatum>.from(
            json["FAQdata"].map((x) => FaQdatum.fromJson(x))),
        responseCode: json["ResponseCode"],
        result: json["Result"],
        responseMsg: json["ResponseMsg"],
      );

  Map<String, dynamic> toJson() => {
        "FAQdata": List<dynamic>.from(faQdata.map((x) => x.toJson())),
        "ResponseCode": responseCode,
        "Result": result,
        "ResponseMsg": responseMsg,
      };
}

class FaQdatum {
  FaQdatum({
    required this.id,
    required this.storeId,
    required this.question,
    required this.answer,
    required this.status,
  });

  String id;
  String storeId;
  String question;
  String answer;
  String status;

  factory FaQdatum.fromJson(Map<String, dynamic> json) => FaQdatum(
        id: json["id"],
        storeId: json["store_id"],
        question: json["question"],
        answer: json["answer"],
        status: json["status"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "store_id": storeId,
        "question": question,
        "answer": answer,
        "status": status,
      };
}
