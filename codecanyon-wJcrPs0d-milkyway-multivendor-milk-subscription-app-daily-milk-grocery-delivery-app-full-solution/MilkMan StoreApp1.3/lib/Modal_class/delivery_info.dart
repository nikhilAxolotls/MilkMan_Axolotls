// To parse this JSON data, do
//
//     final deliveryInfo = deliveryInfoFromJson(jsonString);

import 'dart:convert';

DeliveryInfo deliveryInfoFromJson(String str) =>
    DeliveryInfo.fromJson(json.decode(str));

String deliveryInfoToJson(DeliveryInfo data) => json.encode(data.toJson());

class DeliveryInfo {
  String id;
  String storeId;
  String title;
  String deDigit;
  String status;

  DeliveryInfo({
    required this.id,
    required this.storeId,
    required this.title,
    required this.deDigit,
    required this.status,
  });

  factory DeliveryInfo.fromJson(Map<String, dynamic> json) => DeliveryInfo(
        id: json["id"],
        storeId: json["store_id"],
        title: json["title"],
        deDigit: json["de_digit"],
        status: json["status"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "store_id": storeId,
        "title": title,
        "de_digit": deDigit,
        "status": status,
      };
}
