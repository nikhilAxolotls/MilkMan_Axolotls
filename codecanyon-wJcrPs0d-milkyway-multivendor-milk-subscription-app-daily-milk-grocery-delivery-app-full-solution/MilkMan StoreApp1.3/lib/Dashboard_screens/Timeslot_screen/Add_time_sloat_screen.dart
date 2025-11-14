// ignore_for_file: unused_local_variable, prefer_const_constructors, avoid_print, use_build_context_synchronously, unnecessary_brace_in_string_interps, unused_import, file_names, sort_child_properties_last, must_be_immutable

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:intl/intl.dart';
import 'package:storeappnew/Controller_class/Add_time_slot_controllre.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class AddTimeSloatScreen extends StatefulWidget {
  String? edit;
  AddTimeSloatScreen({this.edit, super.key});

  @override
  State<AddTimeSloatScreen> createState() => _AddTimeSloatScreenState();
}

String tdata = DateFormat("hh:mm").format(DateTime.now());
String time = tdata;
List<String> durations = time.split(':');
List<String> propartyStatus = ["Publish", "UnPublish"];

class _AddTimeSloatScreenState extends State<AddTimeSloatScreen> {
  AddTimeSlotController addTimeSlotController =
      Get.put(AddTimeSlotController());
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  @override
  void initState() {
    super.initState();
    if (widget.edit == "edit") {
      setState(() {
        addTimeSlotController.mintime.text = "";
        addTimeSlotController.mintime.text = addTimeSlotController.question;
        addTimeSlotController.maxtime.text = "";
        addTimeSlotController.maxtime.text =
            addTimeSlotController.answerquestion;
      });
    } else {
      setState(() {
        addTimeSlotController.mintime.text = "";
        addTimeSlotController.maxtime.text = "";
      });
    }
  }

  String slectStatus = propartyStatus.first;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: appbar(title: "Add Time slot"),
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
                  addTimeSlotController.addtimeslot();
                } else {
                  addTimeSlotController.updatetimeslot();
                }
              }
            }),
      ),
      body: Form(
        key: _formKey,
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 14),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              SizedBox(height: Get.height * 0.025),
              Text(
                "Enter Minmum time ",
                style: TextStyle(
                  fontFamily: FontFamily.gilroyBold,
                  fontSize: 16,
                  color: BlackColor,
                ),
              ),
              SizedBox(height: Get.height * 0.015),
              TextFormField(
                controller: addTimeSlotController.mintime,
                decoration: InputDecoration(
                  hintText: "Enter Minmum time",
                  hintStyle: TextStyle(
                      color: Colors.grey,
                      fontFamily: "Gilroy Medium",
                      fontSize: 16),
                  focusedBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: greenColor),
                    borderRadius: BorderRadius.circular(15),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(15),
                    borderSide: BorderSide(color: Colors.grey.shade200),
                  ),
                  border: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.grey.shade200),
                    borderRadius: BorderRadius.circular(15),
                  ),
                ),
                readOnly: true,
                onTap: () async {
                  TimeOfDay? pickedTime = await showTimePicker(
                    initialTime: TimeOfDay.now(),
                    context: context,
                  );

                  if (pickedTime != null) {
                    print(pickedTime.format(context));
                    // DateTime parsedTime = DateFormat.jm()
                    //     .parse(pickedTime.format(context).toString());
                    // print(parsedTime);
                    // String formattedTime =
                    //     DateFormat('HH:mm').format(parsedTime);
                    // print("####################$formattedTime");
                    // String mintime = "2023-03-20T${formattedTime}";
                    // mintime = DateFormat.jm().format(DateTime.parse(mintime));
                    setState(() {
                      addTimeSlotController.mintime.text =
                          pickedTime.format(context);
                    });
                  } else {
                    print("Time is not selected");
                  }
                },
              ),
              SizedBox(height: Get.height * 0.025),
              Text(
                "Enter Maximum time ",
                style: TextStyle(
                  fontFamily: FontFamily.gilroyBold,
                  fontSize: 16,
                  color: BlackColor,
                ),
              ),
              SizedBox(height: Get.height * 0.015),
              TextFormField(
                controller: addTimeSlotController.maxtime,
                decoration: InputDecoration(
                  hintText: "Enter Maximum time",
                  hintStyle: TextStyle(
                      color: Colors.grey,
                      fontFamily: "Gilroy Medium",
                      fontSize: 16),
                  focusedBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: greenColor),
                    borderRadius: BorderRadius.circular(15),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(15),
                    borderSide: BorderSide(color: Colors.grey.shade200),
                  ),
                  border: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.grey.shade200),
                    borderRadius: BorderRadius.circular(15),
                  ),
                ),
                readOnly: true,
                onTap: () async {
                  TimeOfDay? pickedTime = await showTimePicker(
                    initialTime: TimeOfDay.now(),
                    context: context,
                  );

                  if (pickedTime != null) {
                    print(pickedTime.format(context));
                    // DateTime parsedTime = DateFormat.jm()
                    //     .parse(pickedTime.format(context).toString());
                    // print(parsedTime);
                    // String formattedTime =
                    //     DateFormat('HH:mm').format(parsedTime);
                    // print("####################$formattedTime");
                    // String maxtime = "2023-03-20T${formattedTime}";
                    // maxtime = DateFormat.jm().format(DateTime.parse(maxtime));
                    setState(() {
                      addTimeSlotController.maxtime.text =
                          pickedTime.format(context);
                    });
                  } else {
                    print("Time is not selected");
                  }
                },
              ),
              SizedBox(height: Get.height * 0.02),
              Text(
                "Time Status".tr,
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
                      addTimeSlotController.status = "1";
                    } else if (value == "UnPublish") {
                      addTimeSlotController.status = "0";
                    }
                    setState(() {
                      slectStatus = value ?? "";
                      // listOfUser.add(selectValue);
                    });
                  },
                ),
                decoration: BoxDecoration(
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
