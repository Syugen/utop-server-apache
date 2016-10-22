import unittest
from palindromes import *
from dna import *

correctness = [0] * 10
total = [5, 6, 6, 6, 6, 5, 6, 5, 5, 6]
function_names = ['is_palindrome',
                  'is_palindromic_phrase',
                  'get_odd_palindrome_at',
                  'is_base_pair',
                  'is_dna',
                  'is_dna_palindrome',
                  'restriction_sites',
                  'match_enzymes',
                  'one_cutters',
                  'correct_mutations']

class TestIsPalindrome(unittest.TestCase):
    def test_is_palindrome_1(self):
        self.assertTrue(is_palindrome('a'))
        correctness[0] += 1

    def test_is_palindrome_2(self):
        self.assertTrue(is_palindrome('aa'))
        correctness[0] += 1

    def test_is_palindrome_3(self):
        self.assertTrue(is_palindrome('aba'))
        correctness[0] += 1

    def test_is_palindrome_4(self):
        self.assertFalse(is_palindrome('abca'))
        correctness[0] += 1

    def test_is_palindrome_5(self):
        self.assertTrue(is_palindrome('abc' * 100 + 'cba' * 100))
        correctness[0] += 1


class TestIsPalindromePhrase(unittest.TestCase):
    def test_is_palindromic_phrase_1(self):
        self.assertTrue(is_palindromic_phrase('a'))
        correctness[1] += 1

    def test_is_palindromic_phrase_2(self):
        self.assertTrue(is_palindromic_phrase('AA'))
        correctness[1] += 1

    def test_is_palindromic_phrase_3(self):
        self.assertFalse(is_palindromic_phrase('ABCA'))
        correctness[1] += 1

    def test_is_palindromic_phrase_4(self):
        self.assertTrue(is_palindromic_phrase('A, A'))
        correctness[1] += 1

    def test_is_palindromic_phrase_5(self):
        self.assertTrue(is_palindromic_phrase('aA'))
        correctness[1] += 1
        
    def test_is_palindromic_phrase_6(self):
        self.assertTrue(is_palindromic_phrase('A123A'))
        correctness[1] += 1    


class TestGetOddPalindromeAt(unittest.TestCase):
    def test_get_odd_palindrome_at_1(self):
        self.assertEqual(get_odd_palindrome_at('a', 0), 'a')
        correctness[2] += 1

    def test_get_odd_palindrome_at_2(self):
        self.assertEqual(get_odd_palindrome_at('aba', 1), 'aba')
        correctness[2] += 1

    def test_get_odd_palindrome_at_3(self):
        self.assertEqual(get_odd_palindrome_at('abcdc', 3), 'cdc')
        correctness[2] += 1

    def test_get_odd_palindrome_at_4(self):
        self.assertEqual(get_odd_palindrome_at('abcdedcab', 4), 'cdedc')
        correctness[2] += 1

    def test_get_odd_palindrome_at_5(self):
        self.assertEqual(get_odd_palindrome_at('aba', 0), 'a')
        correctness[2] += 1

    def test_get_odd_palindrome_at_6(self):
        self.assertEqual(get_odd_palindrome_at('abc', 2), 'c')
        correctness[2] += 1


class TestIsBasePair(unittest.TestCase):
    def test_is_base_pair_1(self):
        self.assertTrue(is_base_pair('A', 'T'))
        correctness[3] += 1

    def test_is_base_pair_2(self):
        self.assertTrue(is_base_pair('C', 'G'))
        correctness[3] += 1

    def test_is_base_pair_3(self):
        self.assertTrue(is_base_pair('G', 'C'))
        correctness[3] += 1

    def test_is_base_pair_4(self):
        self.assertTrue(is_base_pair('T', 'A'))
        correctness[3] += 1

    def test_is_base_pair_5(self):
        for ch in ['A', 'C', 'G', 'T']:
            self.assertFalse(is_base_pair(ch, ch))
        correctness[3] += 1
    
    def test_is_base_pair_6(self):
        for pair in ['AC', 'AG', 'CA', 'CT', 'GA', 'GT', 'TC', 'TG']:
            self.assertFalse(is_base_pair(pair[0], pair[1]))
        correctness[3] += 1        


class TestIsDNA(unittest.TestCase):
    def test_is_dna_1(self):
        self.assertTrue(is_dna('A', 'T'))
        correctness[4] += 1

    def test_is_dna_2(self):
        self.assertFalse(is_dna('A', 'G'))
        correctness[4] += 1

    def test_is_dna_3(self):
        self.assertTrue(is_dna('ATTTTAAAATAATTATATATA', 'TAAAATTTTATTAATATATAT'))
        correctness[4] += 1

    def test_is_dna_4(self):
        self.assertFalse(is_dna('ATTTTAAAATAATTATATATA', 'TAAAATTTTAATAATATATAT'))
        correctness[4] += 1

    def test_is_dna_5(self):
        self.assertTrue(is_dna('CGCGCGGGCGCGCC', 'GCGCGCCCGCGCGG'))
        correctness[4] += 1

    def test_is_dna_6(self):
        self.assertFalse(is_dna('ATCGATCGATCG', 'ATCGATCGATCG'))
        correctness[4] += 1


class TestIsDNAPalindrome(unittest.TestCase):
    def test_is_dna_palindrome_1(self):
        self.assertTrue(is_dna_palindrome('AT', 'TA'))
        correctness[5] += 1

    def test_is_dna_palindrome_2(self):
        self.assertFalse(is_dna_palindrome('A', 'T'))
        correctness[5] += 1

    def test_is_dna_palindrome_3(self):
        self.assertTrue(is_dna_palindrome('ATCGCGAT', 'TAGCGCTA'))
        correctness[5] += 1

    def test_is_dna_palindrome_4(self):
        self.assertFalse(is_dna_palindrome('ATT', 'TAA'))
        correctness[5] += 1

    def test_is_dna_palindrome_5(self):
        self.assertFalse(is_dna_palindrome('ATCGGCTA', 'TAGCCGAT'))
        correctness[5] += 1


class TestRestrictionSites(unittest.TestCase):    
    def test_restriction_sites_1(self):
        self.assertEqual(restriction_sites('AATTATTA', 'C'), [])
        correctness[6] += 1
    
    def test_restriction_sites_2(self):
        self.assertEqual(restriction_sites('AATT', 'CGGCGGCCCG'), [])
        correctness[6] += 1    

    def test_restriction_sites_3(self):
        self.assertEqual(restriction_sites('AATTATTA', 'A'), [0, 1, 4, 7])
        correctness[6] += 1
    
    def test_restriction_sites_4(self):
        self.assertEqual(restriction_sites('AATTATTA', 'ATTA'), [1]) # No Overlapping
        correctness[6] += 1 

    def test_restriction_sites_5(self):
        self.assertEqual(restriction_sites('AATTATTA', 'ATT'), [1, 4])
        correctness[6] += 1 

    def test_restriction_sites_6(self):
        self.assertEqual(restriction_sites('CGCGCGCGCG', 'CGCG'), [0, 4]) # No Overlapping
        correctness[6] += 1 

class TestMatchEnzymes(unittest.TestCase):
    def setUp(self):
        self.names = ['1', '2', '3', '4']
        self.sequences = ['A', 'AT', 'CG', 'GC']
        self.strand = 'ATCGATCGAAAATTTTCCCCGGGG'
        self.expected = [['1', [0, 4, 8, 9, 10, 11]],
                         ['2', [0, 4, 11]],
                         ['3', [2, 6, 19]],
                         ['4', []]] # include this?        
        
        
    def test_match_enzymes_1(self):
        actual = match_enzymes(self.strand, self.names[:1], self.sequences[:1])
        self.assertEqual(actual, self.expected[:1])
        correctness[7] += 1
        
    def test_match_enzymes_2(self):
        actual = match_enzymes(self.strand, self.names[1:2], self.sequences[1:2])
        self.assertEqual(actual, self.expected[1:2])
        correctness[7] += 1

    def test_match_enzymes_3(self):
        actual = match_enzymes(self.strand, self.names[2:3], self.sequences[2:3])
        self.assertEqual(actual, self.expected[2:3])
        correctness[7] += 1

    def test_match_enzymes_4(self):
        actual = match_enzymes(self.strand, self.names[3:4], self.sequences[3:4])
        self.assertEqual(actual, self.expected[3:4])
        correctness[7] += 1
        
    def test_match_enzymes_5(self):
        actual = match_enzymes(self.strand, self.names, self.sequences)
        self.assertEqual(actual, self.expected)
        correctness[7] += 1
    

class TestOneCutters(unittest.TestCase):   
    def setUp(self):
        self.names = ['1', '2', '3', '4']
        self.sequences = ['A', 'AT', 'CG', 'GC']
        self.strand = 'ATCGATCGAAAATTTTCCCCGGGG'
        self.expected = [['1', [0, 4, 8, 9, 10, 11]],
                         ['2', [0, 4, 11]],
                         ['3', [2, 6, 19]],
                         ['4', []]] # include this?        

    def test_one_cutters_1(self):
        actual = one_cutters('ATCGATCGAAAATTTTCCCCGGGG', ['1'], ['GTA'])
        self.assertEqual(actual, [])
        correctness[8] += 1

    def test_one_cutters_2(self):
        actual = one_cutters('ATCGATCGAAAATTTTCCCCGGGG', ['1'], ['GGG']) # No Overlapping
        self.assertEqual(actual, [['1', 20]])
        correctness[8] += 1

    def test_one_cutters_3(self):
        names = ['1', '2', '3']
        sequences = ['AT', 'ATCGA', 'A']
        expected = [['2', 0]]
        actual = one_cutters('ATCGATCGAAAATTTTCCCCGGGG', names, sequences)
        self.assertEqual(actual, expected)
        correctness[8] += 1

    def test_one_cutters_4(self):
        names = ['1', '2', '3']
        sequences = ['GAT', 'AATT', 'CCCCGGGG']
        expected = [['1', 3], ['2', 10], ['3', 16]]
        actual = one_cutters('ATCGATCGAAAATTTTCCCCGGGG', names, sequences)
        self.assertEqual(actual, expected)
        correctness[8] += 1
    
    def test_one_cutters_5(self):
        names = ['1', '2', '3']
        sequences = ['GATT', 'TA', 'CCCCGGGGG']
        actual = one_cutters('ATCGATCGAAAATTTTCCCCGGGG', names, sequences)
        self.assertEqual(actual, [])
        correctness[8] += 1


class TestCorrectMutations(unittest.TestCase):   
    def test_correct_mutations_1(self):
        strands = ['ACGTTGCCTAGCT']
        names = ['1', '2']
        sequences = ['TT', 'AA']
        correct_mutations(strands, 'ACGGCCTT', names, sequences)  
        self.assertEqual(strands, ['ACGTT'])
        correctness[9] += 1

    def test_correct_mutations_2(self):
        strands = ['ACGTGGCCTAGCT']
        names = ['1', '2', '3']
        sequences = ['AC', 'AA', 'C']
        correct_mutations(strands, 'ACGGCCTT', names, sequences)  
        self.assertEqual(strands, ['ACGGCCTT'])
        correctness[9] += 1

    def test_correct_mutations_3(self):
        strands = ['ACGTGGCCTAGCT']
        names = ['1', '2', '3']
        sequences = ['CGG', 'AA', 'C']
        correct_mutations(strands, 'ACGGCCTT', names, sequences)  
        self.assertEqual(strands, ['ACGTGGCCTAGCT'])
        correctness[9] += 1
    
    def test_correct_mutations_4(self):
        strands = ['ACGTGGCCTAGCT', 'CAGCTGATCG']
        names = ['HaeIII', 'HgaI', 'AluI']
        sequences = ['GGCC', 'GACGC', 'AGCT']
        correct_mutations(strands, 'ACGGCCTT', names, sequences)  
        self.assertEqual(strands, ['ACGTGGCCTT', 'CAGCTGATCG'])
        correctness[9] += 1

    def test_correct_mutations_5(self):
        strands = ['ACGTGGCCTAGCT', 'GGCCCAGCTGATCG']
        names = ['HaeIII', 'HgaI', 'AluI']
        sequences = ['GGCC', 'GACGC', 'AGCT']
        correct_mutations(strands, 'ACGGCCTT', names, sequences)  
        self.assertEqual(strands, ['ACGTGGCCTT', 'GGCCTT'])
        correctness[9] += 1

    def test_correct_mutations_6(self):
        strands = ['ACGTGGCCTAGCT', 'GGCCCAGCGGCCAA']
        names = ['HaeIII', 'HgaI', 'AluI']
        sequences = ['GGCC', 'GACGC', 'AGCT']
        correct_mutations(strands, 'ACGGCCTT', names, sequences)  
        self.assertEqual(strands, ['ACGTGGCCTT', 'GGCCCAGCGGCCAA'])
        correctness[9] += 1

        
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
    print(string)

    file = open('test_result.txt', 'w')
    file.write(string)
    file.close()

    import time
    file = open('a2_test_results.txt', 'a')
    file.write(str(correctness) + ' ' + time.strftime("%Y/%m/%d %H:%M:%S") + '\n')
    file.close()
