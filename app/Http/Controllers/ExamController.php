<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomExam;
use DB;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    public function getExam(Request $request, $room_id){
        $room_exam = DB::table('room_exams as re')
            ->join('exams as e', 'e.exam_id', 're.exam_id')
            ->where('re.room_id', $room_id)
            ->get();

            return $room_exam;
    }

    public function getExaminerExam(Request $request, $examiner_id){
        $examiner_exam = DB::table('exams')
            ->where('examiner_id', $examiner_id)
            ->get();

            return $examiner_exam;
    }

    public function saveExam(Request $request) {
        
        // if the exam is not existing, then create one
        if ($request->input('exam_id') === 0) {

            Log::info('create exam');
            $exam_id = $this->addExam($request);
            return $exam_id;
        }
        // else update
        else {
            Log::info('update exam');
        }
    }

    private function addExam(Request $request) {

        // get exam id
        $exam_id = $this->addExamDetail($request);

        // add the exam id to the request
        $request->merge([
            'exam_id' => $exam_id
        ]);

        
    }

    public function addExamDetail(Request $request) {

        $exam_id = DB::table('exams')->insertGetId([
            'examiner_id' => $request->input('examiner_id'),
            'exam_code' => $request->input('exam_code'),
            'exam_title' => $request->input('exam_title'),
            'exam_desc' => $request->input('exam_desc'),
            'passing_percentage' => $request->input('passing_percentage'),
            'is_examinee_review_enabled' => $request->input('is_examinee_review_enabled'),
            'is_monitoring_switching_tab_enabled' => $request->input('is_monitoring_switching_tab_enabled'),
            'created_by' => $request->input('created_by'),
            'updated_by' => $request->input('created_by')
        ]);

        return ['exam_id' => $exam_id];
    }

    public function updateExamDetail(Request $request) {

        DB::table('exams')
            ->where('exam_id', $exam_id)
            ->update([
                'examiner_id' => $request->input('examiner_id'),
                'exam_code' => $request->input('exam_code'),
                'exam_title' => $request->input('exam_title'),
                'exam_desc' => $request->input('exam_desc'),
                'passing_percentage' => $request->input('passing_percentage'),
                'is_examinee_review_enabled' => $request->input('is_examinee_review_enabled'),
                'is_monitoring_switching_tab_enabled' => $request->input('is_monitoring_switching_tab_enabled'),
                'updated_by' => $request->input('updated_by'),
                'updated_at' => DB::raw('NOW()')
            ]);
    }

    public function addExamSection(Request $request) {

        DB::table('exam_sections')->insert([
            'exam_id' => $request->input('exam_id'),
            'section_no' => $request->input('section_no'),
            'section_title' => $request->input('section_title'),
            'section_desc' => $request->input('section_desc'),
            'shuffle_questions' => $request->input('shuffle_questions'),
            'created_by' => $request->input('created_by'),
            'updated_by' => $request->input('created_by')
        ]);
    }

    public function updateExamSection(Request $request) {

        DB::table('exam_section')
            ->where([
                ['exam_id', $request->input('exam_id')],
                ['section_no', $request->input('old_section_no')]
            ])
            ->update([
                'section_no' => $request->input('new_section_no'),
                'section_title' => $request->input('section_title'),
                'section_desc' => $request->input('section_desc'),
                'shuffle_questions' => $request->input('shuffle_questions'),
                'updated_by' => $request->input('updated_by'),
                'updated_at' => DB::raw('NOW()')
            ]);
    }

    public function deleteExamSection(Request $request) {
        
        // Delete also all the questions under the section
        DB::table('exam_sections')
            ->where([
                ['exam_id', $request->input('exam_id')],
                ['section_no', $request->input('section_no')]
            ])
            ->delete();

        DB::table('questions')
            ->where([
                ['exam_id', $request->input('exam_id')],
                ['section_no', $request->input('section_no')]
            ])
            ->delete();

        // move 1 backward in section_no greater than the deleted section
        readjustSectionsAndQuestions($request);
    }

    public function readjustSectionsAndQuestions(Request $request) {

        // move 1 backward in section_no greater than the deleted section
        DB::table('exam_sections')
            ->where([
                ['exam_id', $request->input('exam_id')],
                ['section_no', '>', $section_no]
            ])
            ->update([
                'updated_by' => $request->input('updated_by'),
                'updated_at' => DB::raw('NOW()')
            ])
            ->decrement('section_no');
        
        DB::table('questions')
            ->where([
                ['exam_id', $request->input('exam_id')],
                ['section_no', '>', $section_no]
            ])
            ->update([
                'updated_by' => $request->input('updated_by'),
                'updated_at' => DB::raw('NOW()')
            ])
            ->decrement('section_no');
    }

    public function deleteExamSectionOnly(Request $request) {
        
        // Delete the section only not the questions under it
        // if there are questions, concat the questions to the section before it
        DB::table('exam_sections')
            ->where([
                ['exam_id', $request->input('exam_id')],
                ['section_no', $request->input('section_no')]
            ])
            ->delete();

        $section_no = $request->input('section_no');

        DB::table('questions')
            ->where([
                ['exam_id', $request->input('exam_id')],
                ['section_no', $section_no]
            ])
            ->update([
                'section_no' => $section_no--,
                'updated_by' => $request->input('updated_by'),
                'updated_at' => DB::raw('NOW()')
            ]);
        
        // move 1 backward in section_no greater than the deleted section
        readjustSectionsAndQuestions($request);
    }

    public function addExamQuestion(Request $request) {

        $question_id = DB::table('questions')->insertGetId([
            'exam_id' => $request->input('exam_id'),
            'section_no' => $request->input('section_no'),
            'item_no' => $request->input('item_no'),
            'question_no' => $request->input('question_no'),
            'question_type_id' => $request->input('question_type_id'),
            'question' => $request->input('total_points'),
            'total_points' => $request->input('question'),
            'created_by' => $request->input('created_by'),
            'updated_by' => $request->input('created_by')
        ]);
        
        switch($request->input('question_type')) {

            case 'SINGLE-SELECT MULTIPLE CHOICE':
                addSingleSelectMultipleChoice($request, $question_id);
                break;
            case 'MULTI-SELECT MULTIPLE CHOICE':
                addMultiSelectMultipleChoice($request, $question_id);
                break;
            case 'TRUE OR FALSE':
                addTrueOrFalse($request, $question_id);
                break;
            case 'FREE-TEXT':
                break;
            case 'ENUMERATION':
                addEnumeration($request, $question_id);
                break;
        }
        
    }

    public function addSingleSelectMultipleChoice(Request $request, int $question_id) {
    
        // saving multi choice question details
        DB::table('multiple_choice_questions')->insert([
            'question_id' => $question_id,
            'select_count' => $request->input('select_count'),
            'points' => $request->input('points'),
            'shuffle_choices' => $request->input('shuffle_choices'),
            'created_by' => $request->input('created_by'),
            'updated_by' => $request->input('created_by')
        ]);

        // saving choices
        addQuestionChoices($question_id, $request->input('choices'));
    }

    public function addMultiSelectMultipleChoice(Request $request, int $question_id) {
    
        // saving multi choice question details
        DB::table('multiple_choice_questions')->insert([
            'question_id' => $question_id,
            'mcq_probability_id' => $request->input('mcq_probability_id'),
            'select_count' => $request->input('select_count'),
            'points' => $request->input('points'),
            'is_points_per_choice' => $request->input('is_points_per_choice'),
            'shuffle_choices' => $request->input('shuffle_choices'),
            'created_by' => $request->input('created_by'),
            'updated_by' => $request->input('created_by')
        ]);

        // saving choices
        addQuestionChoices($question_id, $request->input('choices'));
    }

    public function addQuestionChoices(int $question_id, Array $choices) {
        
        foreach($choices as $choice) {

            DB::table('question_choices')->insert([
                'question_id' => $question_id,
                'choice_no' => $choice->input('choice_no'),
                'choice' => $choice->input('choice'),
                'is_correct' => $choice->input('is_correct'),
                'created_by' => $choice->input('created_by'),
                'updated_by' => $choice->input('created_by')
            ]);
        }
    }

    public function addTrueOrFalse(Request $request, int $question_id) {

        // saving multi choice question details
        DB::table('multiple_choice_questions')->insert([
            'question_id' => $question_id,
            'mcq_probability_id' => 3,
            'select_count' => 1,
            'points' => $request->input('points'),
            'is_points_per_choice' => TRUE,
            'shuffle_choices' => FALSE,
            'created_by' => $request->input('created_by'),
            'updated_by' => $request->input('created_by')
        ]);

        // Make an array of choices
        $answer = $request->input('answer');
        $created_by = $request->input('created_by');

        $choices = [
            ['choice_no' => 1, 'choice' => 'True', 'is_correct' => ($answer == TRUE) ? TRUE : FALSE, 'created_by' => $created_by],
            ['choice_no' => 2, 'choice' => 'False', 'is_correct' => ($answer == FALSE) ? TRUE : FALSE, 'created_by' => $created_by],
        ];

        addQuestionChoices($question_id, $choices);
    }

    public function addEnumeration(Request $request, int $question_id) {

        // saving multi choice question details
        DB::table('enumeration_questions')->insert([
            'question_id' => $question_id,
            'no_of_elements' => $request->input('no_of_elements'),
            'in_order' => $request->input('in_order'),
            'case_insensitive' => $request->input('case_insensitive'),
            'points' => $request->input('points'),
            'is_points_per_elements' => $request->input('is_points_per_elements'),
            'created_by' => $request->input('created_by'),
            'updated_by' => $request->input('created_by')
        ]);

        // saving choices
        addEnumerationElements($question_id, $request->input('elements'));
    }

    public function addEnumerationElements(int $question_id, Array $elements) {

        foreach($elements as $element) {

            DB::table('enumeration_question_elements')->insert([
                'question_id' => $question_id,
                'element_no' => $choice->input('element_no'),
                'element' => $choice->input('element'),
                'created_by' => $choice->input('created_by'),
                'updated_by' => $choice->input('created_by')
            ]);
        }
    }

    // Update Questions
    public function updateQuestion(Request $request) {

        deleteExamQuestion($request->input('question_id'));
        addExamQuestion($request->input('question_id'));
    }

    // Delete Questions
    public function deleteExamQuestion(Request $request) {

        switch($request->input('question_type')) {

            case 'SINGLE-SELECT MULTIPLE CHOICE':
            case 'MULTI-SELECT MULTIPLE CHOICE':
            case 'TRUE OR FALSE':
                deleteMultipleChoiceQuestion($question_id);
                deleteQuestionChoices($question_id);
                break;
            case 'FREE-TEXT':
                break;
            case 'ENUMERATION':
                deleteEnumerationElements($question_id);
                deleteEnumeration($question_id);
                break;
        }

        DB::table('questions')
            ->where('question_id', $request->input('question_id'))
            ->delete();
    }

    public function deleteQuestionChoices(int $question_id) {

        DB::table('question_choices')
            ->where('question_id', $question_id)
            ->delete();
    }

    public function deleteMultipleChoiceQuestion(int $question_id) {

        DB::table('multiple_choice_questions')
            ->where('question_id', $question_id)
            ->delete();
    }

    public function deleteEnumerationElements(int $question_id) {

        DB::table('enumeration_question_elements')
            ->where('question_id', $quesetion_id)
            ->delete();
    }

    public function deleteEnumeration(int $question_id) {

        DB::table('enumeration_questions')
            ->where('question_id', $quesetion_id)
            ->delete();
    }

    // Getter
    public function getExamQuestion(Request $request) {
        
    }
}
