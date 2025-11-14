// To parse this JSON data, do
//
//     final attriInfo = attriInfoFromJson(jsonString);

import 'dart:convert';

AttriInfo attriInfoFromJson(String str) => AttriInfo.fromJson(json.decode(str));

String attriInfoToJson(AttriInfo data) => json.encode(data.toJson());

class AttriInfo {
  List<ProductAttrdatum> productAttrdata;
  String responseCode;
  String result;
  String responseMsg;

  AttriInfo({
    required this.productAttrdata,
    required this.responseCode,
    required this.result,
    required this.responseMsg,
  });

  factory AttriInfo.fromJson(Map<String, dynamic> json) => AttriInfo(
        productAttrdata: List<ProductAttrdatum>.from(
            json["ProductAttrdata"].map((x) => ProductAttrdatum.fromJson(x))),
        responseCode: json["ResponseCode"],
        result: json["Result"],
        responseMsg: json["ResponseMsg"],
      );

  Map<String, dynamic> toJson() => {
        "ProductAttrdata":
            List<dynamic>.from(productAttrdata.map((x) => x.toJson())),
        "ResponseCode": responseCode,
        "Result": result,
        "ResponseMsg": responseMsg,
      };
}

class ProductAttrdatum {
  String id;
  String storeId;
  String productId;
  String productName;
  String title;
  String subscribePrice;
  String normalPrice;
  String outOfStock;
  String discount;
  String subscriptionRequired;

  ProductAttrdatum({
    required this.id,
    required this.storeId,
    required this.productId,
    required this.productName,
    required this.title,
    required this.subscribePrice,
    required this.normalPrice,
    required this.outOfStock,
    required this.discount,
    required this.subscriptionRequired,
  });

  factory ProductAttrdatum.fromJson(Map<String, dynamic> json) =>
      ProductAttrdatum(
        id: json["id"],
        storeId: json["store_id"],
        productId: json["product_id"],
        productName: json["product_name"],
        title: json["title"],
        subscribePrice: json["subscribe_price"],
        normalPrice: json["normal_price"],
        outOfStock: json["out_of_stock"],
        discount: json["discount"],
        subscriptionRequired: json["subscription_required"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "store_id": storeId,
        "product_id": productId,
        "product_name": productName,
        "title": title,
        "subscribe_price": subscribePrice,
        "normal_price": normalPrice,
        "out_of_stock": outOfStock,
        "discount": discount,
        "subscription_required": subscriptionRequired,
      };
}
