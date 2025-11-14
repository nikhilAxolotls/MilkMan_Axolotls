// ignore_for_file: prefer_const_constructors, sort_child_properties_last, file_names, must_be_immutable

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Add_Faq_controller.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class AddFaqs extends StatefulWidget {
  String? edit;
  AddFaqs({this.edit, super.key});

  @override
  State<AddFaqs> createState() => _AddFaqsState();
}

List<String> propartyStatus = ["Publish", "UnPublish"];

class _AddFaqsState extends State<AddFaqs> {
  AddFaqsController addFaqsController = Get.put(AddFaqsController());
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  @override
  void initState() {
    super.initState();
    if (widget.edit == "edit") {
      setState(() {
        addFaqsController.queation.text = "";
        addFaqsController.queation.text = addFaqsController.question;
        addFaqsController.answer.text = "";
        addFaqsController.answer.text = addFaqsController.answerquestion;
      });
    } else {
      setState(() {
        addFaqsController.queation.text = "";
        addFaqsController.answer.text = "";
      });
    }
  }

  String slectStatus = propartyStatus.first;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: appbar(title: "Add Faq's"),
      backgroundColor: WhiteColor,
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
                if (widget.edit == "Add") {
                  addFaqsController.addfaqs();
                } else {
                  addFaqsController.updatefaqs();
                }
              }
            }),
      ),
      body: Form(
        key: _formKey,
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 12),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              textfield(
                type: "Enter Question",
                controller: addFaqsController.queation,
                labelText: "Enter Question",
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please Enter Question';
                  }
                  return null;
                },
              ),
              textfield(
                type: "Enter Answer",
                controller: addFaqsController.answer,
                labelText: "Enter Answer",
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please Enter Answer';
                  }
                  return null;
                },
              ),
              SizedBox(height: Get.height * 0.02),
              Text(
                "Faq's Status".tr,
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
                // margin: EdgeInsets.symmetric(horizontal: 10),
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
                      addFaqsController.status = "1";
                    } else if (value == "UnPublish") {
                      addFaqsController.status = "0";
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
  }
}
