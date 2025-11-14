// ignore_for_file: unused_local_variable, prefer_const_constructors, avoid_print, use_build_context_synchronously, unnecessary_brace_in_string_interps, unused_import, file_names, sort_child_properties_last

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:intl/intl.dart';
import 'package:storeappnew/Controller_class/Add_time_slot_controllre.dart';
import 'package:storeappnew/Controller_class/Time_slot_controllre.dart';
import 'package:storeappnew/Dashboard_screens/Timeslot_screen/Add_time_sloat_screen.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class TimeSloatscreen extends StatefulWidget {
  const TimeSloatscreen({super.key});

  @override
  State<TimeSloatscreen> createState() => _TimeSloatscreenState();
}

String tdata = DateFormat("hh:mm").format(DateTime.now());
String time = tdata;
List<String> durations = time.split(':');
List<String> propartyStatus = ["Publish", "UnPublish"];

class _TimeSloatscreenState extends State<TimeSloatscreen> {
  @override
  void initState() {
    super.initState();
    timeslotController.timeslot();
  }

  TimeslotController timeslotController = Get.put(TimeslotController());
  AddTimeSlotController addTimeSlotController =
      Get.put(AddTimeSlotController());

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: CustomAppbar(
        title: "Time Sloat",
        onTap: () {
          Get.to(() => AddTimeSloatScreen(
                edit: "Add",
              ));
        },
      ),
      body: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 14),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            SizedBox(height: Get.height * 0.02),
            GetBuilder<TimeslotController>(builder: (context) {
              return timeslotController.isLoading
                  ? ListView.builder(
                      shrinkWrap: true,
                      itemCount:
                          timeslotController.timesloatinfo?.gallerydata.length,
                      padding: EdgeInsets.zero,
                      physics: NeverScrollableScrollPhysics(),
                      itemBuilder: (context, index) {
                        return Stack(
                          children: [
                            Container(
                              height: 70,
                              width: Get.size.width,
                              margin: EdgeInsets.all(10),
                              child: Row(
                                children: [
                                  SizedBox(
                                    width: 10,
                                  ),
                                  Container(
                                    height: 50,
                                    width: 50,
                                    padding: EdgeInsets.all(13),
                                    alignment: Alignment.center,
                                    child:
                                        Image.asset("assets/stopwatch-alt.png"),
                                    decoration: BoxDecoration(
                                        gradient: gradient.btnGradient,
                                        borderRadius:
                                            BorderRadius.circular(10)),
                                  ),
                                  SizedBox(
                                    width: 10,
                                  ),
                                  Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      GetBuilder<TimeslotController>(
                                          builder: (context) {
                                        String mintime =
                                            "2023-03-20T${timeslotController.timesloatinfo!.gallerydata[index].mintime}";
                                        String maxtime =
                                            "2023-03-20T${timeslotController.timesloatinfo!.gallerydata[index].maxtime}";
                                        return Text(
                                          // categoryController.categoryinfo
                                          //         ?.categorydata[index].title ??
                                          "${DateFormat.jm().format(DateTime.parse(mintime))} to ${DateFormat.jm().format(DateTime.parse(maxtime))}",
                                          style: TextStyle(
                                            color: BlackColor,
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 16,
                                          ),
                                        );
                                      }),
                                      SizedBox(height: Get.height * 0.005),
                                      timeslotController.timesloatinfo
                                                  ?.gallerydata[index].status ==
                                              "0"
                                          ? Text(
                                              "UnPublish",
                                              style: TextStyle(
                                                color: greycolor,
                                                fontFamily:
                                                    FontFamily.gilroyMedium,
                                              ),
                                            )
                                          : Text(
                                              "Publish",
                                              style: TextStyle(
                                                color: greyColor,
                                                fontFamily:
                                                    FontFamily.gilroyMedium,
                                              ),
                                            ),
                                    ],
                                  )
                                ],
                              ),
                              decoration: BoxDecoration(
                                border: Border.all(color: Colors.grey.shade200),
                                borderRadius: BorderRadius.circular(15),
                              ),
                            ),
                            Positioned(
                              top: 0,
                              right: 0,
                              child: InkWell(
                                onTap: () {
                                  addTimeSlotController.getIdAndName(
                                      recId: timeslotController.timesloatinfo
                                              ?.gallerydata[index].id ??
                                          "",
                                      qurstionid:
                                          "${timeslotController.timesloatinfo?.gallerydata[index].mintime}",
                                      answerid:
                                          "${timeslotController.timesloatinfo?.gallerydata[index].maxtime}");
                                  Get.to(() => AddTimeSloatScreen(
                                        edit: "edit",
                                      ));
                                },
                                child: Container(
                                  height: 35,
                                  width: 35,
                                  padding: EdgeInsets.all(9),
                                  alignment: Alignment.center,
                                  child: Image.asset("assets/Edit.png"),
                                  decoration: BoxDecoration(
                                    shape: BoxShape.circle,
                                    gradient: gradient.btnGradient,
                                  ),
                                ),
                              ),
                            )
                          ],
                        );
                      },
                    )
                  : SizedBox(
                      height: Get.size.height,
                      width: Get.size.width,
                      child: Center(
                        child: CircularProgressIndicator(
                          color: greenColor,
                        ),
                      ),
                    );
            })
          ],
        ),
      ),
    );
  }
}
