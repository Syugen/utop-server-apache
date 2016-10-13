import user_submission as admission
import unittest

correctness = [0, 0, 0, 0, 0, 0]
total = [11, 5, 3, 4, 7, 7]
function_names = ['is_special_case',
                  'get_final_mark',
                  'get_both_marks',
                  'extract_course',
                  'applied_to_degree',
                  'decide_admission']

class TestAdmissionDefault(unittest.TestCase):
    def setUp(self):
        admission.SPECIAL_CASE_SCHOOL_1 = 'Fort McMurray Composite High'
        admission.SPECIAL_CASE_SCHOOL_2 = 'Father Mercredi High School'
        admission.SPECIAL_CASE_YEAR = '2016'

    def test_is_special_case_1(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertTrue(admission.is_special_case(record))
        correctness[0] += 1

    def test_is_special_case_2(self):
        record = 'Jacqueline Smith,Father Mercredi High School,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertTrue(admission.is_special_case(record))
        correctness[0] += 1

    def test_is_special_case_3(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2015,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.is_special_case(record))
        correctness[0] += 1

    def test_is_special_case_4(self):
        record = 'Jacqueline Smith,Random High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.is_special_case(record))
        correctness[0] += 1

    def test_is_special_case_5(self):
        record = 'Jacqueline Smith,Random High,2012,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.is_special_case(record))
        correctness[0] += 1


    def test_get_final_mark_1(self):
        record = 'Jacqueline Smith,Random High,2012,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertEqual(admission.get_final_mark(record, '90', '92'), 91.0)
        self.assertTrue(type(admission.get_final_mark(record, '90', '92')) is float)
        correctness[1] += 1

    def test_get_final_mark_2(self):
        record = 'Jacqueline Smith,Random High,2012,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertEqual(admission.get_final_mark(record, '90', '91'), 90.5)
        correctness[1] += 1

    def test_get_final_mark_3(self):
        record = 'Jacqueline Smith,Random High,2012,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertEqual(admission.get_final_mark(record, '90', 'NE'), 45.0)
        correctness[1] += 1

    def test_get_final_mark_4(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertEqual(admission.get_final_mark(record, '90', 'NE'), 90.0)
        self.assertTrue(type(admission.get_final_mark(record, '90', 'NE')) is float)
        correctness[1] += 1

    def test_get_final_mark_5(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertEqual(admission.get_final_mark(record, '90', '92'), 91.0)
        self.assertTrue(type(admission.get_final_mark(record, '90', '92')) is float)
        correctness[1] += 1


    def test_get_both_marks_1(self):
        record = 'MAT,90,94'
        self.assertEqual(admission.get_both_marks(record, 'MAT'), '90 94')
        correctness[2] += 1

    def test_get_both_marks_2(self):
        record = 'ENG,92,NE'
        self.assertEqual(admission.get_both_marks(record, 'ENG'), '92 NE')
        correctness[2] += 1

    def test_get_both_marks_3(self):
        record = 'MAT,90,94'
        self.assertEqual(admission.get_both_marks(record, 'ABC'), '')
        correctness[2] += 1


    def test_extract_course_1(self):
        record = 'MAT,90,94,ENG,92,NE,CHM,80,85'
        self.assertEqual(admission.extract_course(record, 1), 'MAT,90,94')
        correctness[3] += 1

    def test_extract_course_2(self):
        record = 'MAT,90,94,ENG,92,NE,CHM,80,85'
        self.assertEqual(admission.extract_course(record, 2), 'ENG,92,NE')
        correctness[3] += 1

    def test_extract_course_3(self):
        record = 'MAT,90,94,ENG,92,NE,CHM,80,85'
        self.assertEqual(admission.extract_course(record, 3), 'CHM,80,85')
        correctness[3] += 1

    def test_extract_course_4(self):
        record = 'ABC,90,94,ENG,92,NE,CHM,80,85'
        self.assertEqual(admission.extract_course(record, 1), 'ABC,90,94')
        correctness[3] += 1


    def test_applied_to_degree_1(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertTrue(admission.applied_to_degree(record, 'BArts'))
        correctness[4] += 1

    def test_applied_to_degree_2(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.applied_to_degree(record, 'BSci'))
        correctness[4] += 1

    def test_applied_to_degree_3(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.applied_to_degree(record, 'BArts?'))
        correctness[4] += 1

    def test_applied_to_degree_4(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.applied_to_degree(record, 'Arts'))
        correctness[4] += 1

    def test_applied_to_degree_5(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.applied_to_degree(record, ',BArts'))
        correctness[4] += 1

    def test_applied_to_degree_6(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,LOL'
        self.assertTrue(admission.applied_to_degree(record, 'LOL'))
        correctness[4] += 1

    def test_applied_to_degree_7(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,Whatever'
        self.assertFalse(admission.applied_to_degree(record, 'What'))
        correctness[4] += 1


    def test_decide_admission_1(self):
        self.assertEqual(admission.decide_admission(80, 80), 'accept')
        correctness[5] += 1

    def test_decide_admission_2(self):
        self.assertEqual(admission.decide_admission(80, 79.9), 'accept')
        correctness[5] += 1

    def test_decide_admission_3(self):
        self.assertEqual(admission.decide_admission(80, 80.1), 'reject')
        correctness[5] += 1

    def test_decide_admission_4(self):
        self.assertEqual(admission.decide_admission(80, 75), 'accept with scholarship')
        correctness[5] += 1

    def test_decide_admission_5(self):
        self.assertEqual(admission.decide_admission(80, 75.1), 'accept')
        correctness[5] += 1

    def test_decide_admission_6(self):
        self.assertEqual(admission.decide_admission(80, 74.9), 'accept with scholarship')
        correctness[5] += 1

    def test_decide_admission_7(self):
        self.assertEqual(admission.decide_admission(80, 85), 'reject')
        correctness[5] += 1


class TestAdmissionSpecialSchool(unittest.TestCase):
    def setUp(self):
        admission.SPECIAL_CASE_SCHOOL_1 = 'Fort McMurray Composite High'
        admission.SPECIAL_CASE_SCHOOL_2 = 'Fake School'
        admission.SPECIAL_CASE_YEAR = '2016'

    def test_is_special_case_6(self):
        record = 'Jacqueline Smith,Fake School,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertTrue(admission.is_special_case(record))
        correctness[0] += 1

    def test_is_special_case_7(self):
        record = 'Jacqueline Smith,Father Mercredi High School,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.is_special_case(record))
        correctness[0] += 1

    def test_is_special_case_8(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertTrue(admission.is_special_case(record))
        correctness[0] += 1


class TestAdmissionYear(unittest.TestCase):
    def setUp(self):
        admission.SPECIAL_CASE_SCHOOL_1 = 'Fort McMurray Composite High'
        admission.SPECIAL_CASE_SCHOOL_2 = 'Father Mercredi High School'
        admission.SPECIAL_CASE_YEAR = '1999'

    def test_is_special_case_9(self):
        record = 'Jacqueline Smith,Fort McMurray Composite High,2016,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.is_special_case(record))
        correctness[0] += 1

    def test_is_special_case_10(self):
        record = 'Jacqueline Smith,Father Mercredi High School,1999,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertTrue(admission.is_special_case(record))
        correctness[0] += 1

    def test_is_special_case_11(self):
        record = 'Jacqueline Smith,Fake School,1999,MAT,90,94,ENG,92,88,CHM,80,85,BArts'
        self.assertFalse(admission.is_special_case(record))
        correctness[0] += 1
        
if __name__ == '__main__':
    unittest.main(exit=False)

    string = ''    
    for i in range(len(total)):
        string += '    ' + function_names[i] + ': ' + \
            str(correctness[i]) + '/' + str(total[i]) + '\n'
    string += 'Total: ' + str(sum(correctness)) + '/' + str(sum(total)) + '\n'
    if sum(correctness) == sum(total):
        string += 'Congratulations! You passed all our tests.\n'
    string += 'Please note that we didn\'t check your style and docstring.'
    
    file = open('test_result.txt', 'w')
    file.write(string)
    file.close()

    file = open('all_test_results/amount.txt')
    amount = int(file.readline()) + 1
    file.close()

    file = open('all_test_results/amount.txt', 'w')
    file.write(str(amount))
    file.close()

    file = open('all_test_results/test_result_' + str(amount) + '.txt', 'w')
    file.write(string)
    file.close()
