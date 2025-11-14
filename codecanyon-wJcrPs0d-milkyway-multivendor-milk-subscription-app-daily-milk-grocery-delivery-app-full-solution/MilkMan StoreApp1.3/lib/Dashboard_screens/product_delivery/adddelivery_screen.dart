// ignore_for_file: must_be_immutable, prefer_const_constructors, sort_child_properties_last

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/adddelivery_controller.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class AddDeliveryScreen extends StatefulWidget {
  String? add;
  String? deliveryStatus;
  AddDeliveryScreen({this.add, this.deliveryStatus, super.key});

  @override
  State<AddDeliveryScreen> createState() => _AddDeliveryScreenState();
}

List<String> propartyStatus = ["Publish", "UnPublish"];

class _AddDeliveryScreenState extends State<AddDeliveryScreen> {
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  AddDeliveryController addDeliveryController =
      Get.put(AddDeliveryController());

  String slectStatus = propartyStatus.first;

  @override
  void initState() {
    super.initState();
    if (widget.add == "Add") {
      addDeliveryController.emptyValue();
    } else if (widget.add == "edit") {
      setState(() {
        slectStatus = widget.deliveryStatus ?? "";
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: appbar(title: "Add Deliveries"),
      bottomNavigationBar: Padding(
        padding: EdgeInsets.symmetric(horizontal: 12, vertical: 12),
        child: GestButton(
            Width: Get.size.width,
            height: 55,
            buttoncolor: greenColor,
            buttontext: "Update".tr,
            style: TextStyle(
              fontFamily: FontFamily.gilroyBold,
              color: WhiteColor,
              fontSize: 16,
              fontWeight: FontWeight.bold,
            ),
            onclick: () {
              if (_formKey.currentState?.validate() ?? false) {
                if (widget.add == "Add") {
                  addDeliveryController.addDeliveries();
                } else if (widget.add == "edit") {
                  addDeliveryController.editDeliveries();
                }
              }
            }),
      ),
      body: GetBuilder<AddDeliveryController>(builder: (context) {
        return SizedBox(
          height: Get.size.height,
          width: Get.size.width,
          child: Padding(
            padding: const EdgeInsets.symmetric(horizontal: 15),
            child: Form(
              key: _formKey,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  SizedBox(height: Get.height * 0.02),
                  textfield(
                    type: "Deliveries Title".tr,
                    controller: addDeliveryController.deliveriesTitle,
                    labelText: "Enter Deliveries Title".tr,
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Please Enter Deliveries Title'.tr;
                      }
                      return null;
                    },
                  ),
                  SizedBox(height: Get.height * 0.02),
                  textfield(
                    type: "Deliveries IN Digit".tr,
                    controller: addDeliveryController.deliveriesDegit,
                    labelText: "Enter Deliveries IN Digit".tr,
                    textInputType: TextInputType.number,
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Please Enter Deliveries IN Digit'.tr;
                      }
                      return null;
                    },
                  ),
                  SizedBox(height: Get.height * 0.012),
                  Text(
                    "Product Status".tr,
                    style: TextStyle(
                      fontFamily: FontFamily.gilroyBold,
                      fontSize: 16,
                      color: BlackColor,
                    ),
                  ),
                  SizedBox(height: Get.height * 0.012),
                  Container(
                    height: 60,
                    width: Get.size.width,
                    alignment: Alignment.center,
                    padding: EdgeInsets.only(left: 15, right: 15),
                    child: DropdownButton(
                      value: slectStatus,
                      icon: Image.asset(
                        'assets/Arrowdown.png',
                        height: 20,
                        width: 20,
                      ),
                      isExpanded: true,
                      underline: SizedBox.shrink(),
                      items: propartyStatus
                          .map<DropdownMenuItem<String>>((String value) {
                        return DropdownMenuItem<String>(
                          value: value,
                          child: Text(
                            value,
                            style: TextStyle(
                              fontFamily: FontFamily.gilroyMedium,
                              color: BlackColor,
                              fontSize: 14,
                            ),
                          ),
                        );
                      }).toList(),
                      onChanged: (value) {
                        if (value == "Publish") {
                          addDeliveryController.status = "1";
                        } else if (value == "UnPublish") {
                          addDeliveryController.status = "0";
                        }
                        setState(() {
                          slectStatus = value ?? "";
                          // listOfUser.add(selectValue);
                        });
                      },
                    ),
                    decoration: BoxDecoration(
                      color: WhiteColor,
                      borderRadius: BorderRadius.circular(15),
                      border: Border.all(color: Colors.grey.shade200),
                    ),
                  ),
                ],
              ),
            ),
          ),
        );
      }),
    );
  }
}
